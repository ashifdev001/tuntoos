<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Http\Controllers\API\BaseController;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GalleryController extends BaseController
{
    public function index(Request $request)
    {
        
        $perPage = $request->input('per_page', 10);
        $searchTitle = trim($request->input('search'));
        $query = Gallery::query();
        if (!empty($searchTitle)) {
            $query->where('title', 'LIKE', '%' . $searchTitle . '%');
        }
        $galleries = $query->paginate($perPage);
        return $this->sendResponse($galleries, 'Gallery list fetched successfully.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|in:gallery,videos',
            'title' => 'required|string|max:255',
            'images.*' => 'required|image'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422);
        }

        $saved = [];

        foreach ($request->file('images') as $image) {
            $path = ImageuploadHelper::uploadImage($image, 'galleries');
            $gallery = Gallery::create([
                'service_id' => $request->service_id,
                'title' => $request->title,
                'description' => $request->description,
                'url' => $path['path'],
            ]);
            $saved[] = $gallery;
        }

        return $this->sendResponse($saved, 'Images uploaded successfully.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return $this->sendError('Gallery not found', 404);
        }

        // Delete image file
        ImageuploadHelper::removeImageFromDisk($gallery->url);
        $gallery->delete();

        return $this->sendResponse([], 'Gallery deleted successfully.');
    }

     public function show($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return $this->sendError('Gallery not found', 404);
        }

        return $this->sendResponse($gallery, 'Gallery fetched successfully.');
    }

    /**
     * Update the specified gallery item.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return $this->sendError('Gallery not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|in:gallery,videos',
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'images' => 'sometimes',
            'images.*' => 'image|max:6048'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), 422);
        }
        DB::beginTransaction();
        $uploadedPaths = [];
        try {
            // Update simple fields
            if ($request->has('type')) {
                $gallery->type = $request->input('type');
            }
            if ($request->has('title')) {
                $gallery->title = $request->input('title');
            }
            if ($request->has('description')) {
                $gallery->description = $request->input('description');
            }

            // If images provided, support array of images. We'll replace this gallery's image with the first
            // and create new gallery records for any additional images.
            if ($request->hasFile('images')) {
                $fileInput = $request->file('images');
                $files = is_array($fileInput) ? $fileInput : [$fileInput];

                // upload each file; first replaces current gallery, rest create new records
                foreach ($files as $idx => $file) {
                    $path = ImageuploadHelper::uploadImage($file, 'galleries');
                    $uploadedPaths[] = $path['path'];

                    if ($idx === 0) {
                        // remove old image
                        ImageuploadHelper::removeImageFromDisk($gallery->url);
                        $gallery->url = $path['path'];
                    } else {
                        // create new gallery record with same type/title (use updated values if provided)
                        Gallery::create([
                            'type' => $gallery->type,
                            'title' => $gallery->title,
                            'description' => $gallery->description,
                            'url' => $path['path'],
                        ]);
                    }
                }
            }

            $gallery->save();

            DB::commit();
            return $this->sendResponse($gallery, 'Gallery updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            // cleanup any uploaded files to avoid orphaned files
            try {
                foreach ($uploadedPaths as $p) {
                    ImageuploadHelper::removeImageFromDisk($p);
                }
            } catch (\Exception $ee) {
                // ignore cleanup errors
            }

            return $this->sendError('Failed to update gallery: ' . $e->getMessage(), 500);
        }
    }
}

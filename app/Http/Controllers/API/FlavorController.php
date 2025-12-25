<?php

namespace App\Http\Controllers\API;

use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Classes\ImageuploadHelper;

class FlavorController extends BaseController
{
    /**
     * GET /api/flavors
     * List all flavors with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Flavor::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $flavors = $query->latest()->paginate($perPage);

        return $this->sendResponse($flavors, 'Flavors retrieved successfully.');
    }

    /**
     * POST /api/flavors
     * Create a new flavor.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'nullable|string|max:255|unique:flavors,title',
            'description' => 'nullable|string',
            'tag'         => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                $validator->errors()->first(),
                $validator->errors(),
                400
            );
        }

        $data = $validator->validated();
        $data['slug']  = !empty($data['title']) ? Str::slug($data['title']) : uniqid();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'flavors');
            $data['image'] = $upload['path'];
        }

        $flavor = Flavor::create($data);

        return $this->sendResponse($flavor, 'Flavor created successfully.');
    }

    /**
     * GET /api/flavors/{id}
     * Show a single flavor.
     */
    public function show(Flavor $flavor)
    {
        return $this->sendResponse($flavor, 'Flavor retrieved successfully.');
    }

    /**
     * PUT /api/flavors/{id}
     * Update an existing flavor.
     */
    public function update(Request $request, Flavor $flavor)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'nullable|string|max:255|unique:flavors,title,' . $flavor->id,
            'tag'         => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                $validator->errors()->first(),
                $validator->errors(),
                400
            );
        }

        $flavor->title       = $request->title;
        $flavor->tag         = $request->tag;
        $flavor->description = $request->description;
        $flavor->slug        = Str::slug($request->title);

        if ($request->hasFile('image')) {
            if ($flavor->image) {
                ImageuploadHelper::removeImageFromDisk($flavor->image);
            }

            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'flavors');
            $flavor->image = $upload['path'];
        }

        $flavor->save();

        return $this->sendResponse($flavor, 'Flavor updated successfully.');
    }

    /**
     * DELETE /api/flavors/{id}
     * Delete a flavor.
     */
    public function destroy(Flavor $flavor)
    {
        if ($flavor->image) {
            ImageuploadHelper::removeImageFromDisk($flavor->image);
        }

        $flavor->delete();

        return $this->sendResponse([], 'Flavor deleted successfully.');
    }
}

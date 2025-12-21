<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banner::query();

        // Search by title
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $banners = $query->orderBy('id', 'DESC')->paginate($perPage);

        return $this->sendResponse($banners, 'Banners retrieved successfully.');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255|unique:banners,title',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'btn_txt' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $banner = Banner::create([
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'subtitle' => $request->input('subtitle'),
            'image' => null,
            'btn_txt' => $request->input('btn_txt'),
            'link' => $request->input('link'),
            'status' => $request->input('status', 'inactive'),
        ]);

        if ($request->hasFile('image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'banners');
            $banner->image = $imageName['path'];
            $banner->save();
        }

        return $this->sendResponse($banner, 'Banner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return $this->sendResponse($banner, 'Banner retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255|unique:banners,title,' . $banner->id,
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'btn_txt' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $banner->title = $request->input('title');
        $banner->type = $request->input('type');
        $banner->subtitle = $request->input('subtitle');
        $banner->btn_txt = $request->input('btn_txt');
        $banner->link = $request->input('link');
        $banner->status = $request->input('status', $banner->status);

        if ($request->hasFile('image')) {
            ImageuploadHelper::removeImageFromDisk($banner->image);
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'banners');
            $banner->image = $imageName['path'];
        }

        $banner->save();

        return $this->sendResponse($banner, 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Remove image from disk if exists
        if ($banner->image) {
            ImageuploadHelper::removeImageFromDisk($banner->image);
        }

        $banner->delete();

        return $this->sendResponse([], 'Banner deleted successfully.');
    }
}

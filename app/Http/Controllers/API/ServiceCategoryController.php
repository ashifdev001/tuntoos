<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ServiceCategory::query();

        // Search by title
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by any other fields if needed (example: status)
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $categories = $query->paginate($perPage);

        return $this->sendResponse($categories, 'Service categories retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:service_categories,title',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $serviceCategory = ServiceCategory::create($request->only('title','description'));


        if ($request->hasFile('image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'service_categories');
            $serviceCategory->image = $imageName['path'];
        }
        
         if ($request->hasFile('cover_image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('cover_image'), 'service_categories');
            $serviceCategory->cover_image = $imageName['path'];
        }

        $serviceCategory->save();

        return $this->sendResponse($serviceCategory, 'Service category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceCategory $serviceCategory)
    {
        return $this->sendResponse($serviceCategory, 'Service category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:service_categories,title,' . $serviceCategory->id,
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $serviceCategory->title = $request->title;
        $serviceCategory->description = $request->description;

        if ($request->hasFile('image')) {
            ImageuploadHelper::removeImageFromDisk($serviceCategory->image);
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'service_categories');
            $serviceCategory->image = $imageName['path'];
        }
        
         if ($request->hasFile('cover_image')) {
             ImageuploadHelper::removeImageFromDisk($serviceCategory->cover_image);
            $imageName = ImageuploadHelper::uploadImage($request->file('cover_image'), 'service_categories');
            $serviceCategory->cover_image = $imageName['path'];
        }

        $serviceCategory->save();

        return $this->sendResponse($serviceCategory, 'Service category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        if ($serviceCategory->image) {
            ImageuploadHelper::removeImageFromDisk($serviceCategory->image);
        }
         if ($serviceCategory->cover_image) {
            ImageuploadHelper::removeImageFromDisk($serviceCategory->cover_image);
        }
        $serviceCategory->delete();
        return $this->sendResponse([], 'Service category deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\ImageuploadHelper;

class BrandController extends BaseController
{
    /**
     * GET /api/brands
     * List all brands with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Brand::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $brands = $query->latest()->paginate($perPage);

        return $this->sendResponse($brands, 'Brands retrieved successfully.');
    }

    /**
     * POST /api/brands
     * Create a new brand.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255|unique:brands,name',
            'link'  => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'brands');
            $data['image'] = $upload['path'];
        }

        $brand = Brand::create($data);

        return $this->sendResponse($brand, 'Brand created successfully.');
    }

    /**
     * GET /api/brands/{id}
     * Show a single brand.
     */
    public function show(Brand $brand)
    {
        return $this->sendResponse($brand, 'Brand retrieved successfully.');
    }

    /**
     * PUT /api/brands/{id}
     * Update an existing brand.
     */
    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'link'  => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $brand->name = $request->input('name');
        $brand->link = $request->input('link');

        if ($request->hasFile('image')) {
            if ($brand->image) {
                ImageuploadHelper::removeImageFromDisk($brand->image);
            }
            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'brands');
            $brand->image = $upload['path'];
        }

        $brand->save();

        return $this->sendResponse($brand, 'Brand updated successfully.');
    }

    /**
     * DELETE /api/brands/{id}
     * Delete a brand.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image) {
            ImageuploadHelper::removeImageFromDisk($brand->image);
        }

        $brand->delete();

        return $this->sendResponse([], 'Brand deleted successfully.');
    }

}

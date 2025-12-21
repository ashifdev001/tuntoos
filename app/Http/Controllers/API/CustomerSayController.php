<?php

namespace App\Http\Controllers\API;

use App\Models\CustomerSay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classes\ImageuploadHelper;

class CustomerSayController extends BaseController
{
    /**
     * Display a listing of the resource with optional search & pagination.
     */
    public function index(Request $request)
    {
        $query = CustomerSay::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $items = $query->latest()->paginate($perPage);

        return $this->sendResponse($items, 'Customer feedback retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'message'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $image = ImageuploadHelper::uploadImage($request->file('image'), 'customersay');
            $data['image'] = $image['path'];
        }

        $item = CustomerSay::create($data);

        return $this->sendResponse($item, 'Customer feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerSay $customerSay)
    {
        return $this->sendResponse($customerSay, 'Customer feedback retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerSay $customerSay)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'message'  => 'required|string',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $customerSay->name     = $request->input('name');
        $customerSay->location = $request->input('location');
        $customerSay->message  = $request->input('message');

        if ($request->hasFile('image')) {
            // Remove old image
            if ($customerSay->image) {
                ImageuploadHelper::removeImageFromDisk($customerSay->image);
            }

            $image = ImageuploadHelper::uploadImage($request->file('image'), 'customersay');
            $customerSay->image = $image['path'];
        }

        $customerSay->save();

        return $this->sendResponse($customerSay, 'Customer feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerSay $customerSay)
    {
        if ($customerSay->image) {
            ImageuploadHelper::removeImageFromDisk($customerSay->image);
        }

        $customerSay->delete();

        return $this->sendResponse([], 'Customer feedback deleted successfully.');
    }

}

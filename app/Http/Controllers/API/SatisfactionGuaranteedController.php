<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\SatisfactionGuaranteed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatisfactionGuaranteedController extends BaseController
{
    /**
     * GET /api/satisfaction-guaranteed
     * List records with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = SatisfactionGuaranteed::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('icon', 'like', '%' . $request->search . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $items = $query->latest()->paginate($perPage);

        return $this->sendResponse($items, 'Satisfaction items retrieved successfully.');
    }

    /**
     * POST /api/satisfaction-guaranteed
     * Create a new record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:satisfaction_guaranteeds,title',
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        if ($request->hasFile('icon')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('icon'), 'satisfaction_guaranteed');
            $data['icon'] = $imageName['path'];
        }

        $item = SatisfactionGuaranteed::create($data);

        return $this->sendResponse($item, 'Satisfaction item created successfully.');
    }

    /**
     * GET /api/satisfaction-guaranteed/{id}
     * Show a single record.
     */
    public function show(SatisfactionGuaranteed $satisfactionGuaranteed)
    {
        return $this->sendResponse($satisfactionGuaranteed, 'Satisfaction item retrieved successfully.');
    }

    /**
     * PUT /api/satisfaction-guaranteed/{id}
     * Update an existing record.
     */
    public function update(Request $request, SatisfactionGuaranteed $satisfactionGuaranteed)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:satisfaction_guaranteeds,title,' . $satisfactionGuaranteed->id,
            'description' => 'required|string',
            'icon' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        if ($request->hasFile('icon')) {
            ImageuploadHelper::removeImageFromDisk($satisfactionGuaranteed->icon);
            $imageName = ImageuploadHelper::uploadImage($request->file('icon'), 'satisfaction_guaranteed');
            $data['icon'] = $imageName['path'];
        }

        $satisfactionGuaranteed->update($data);

        return $this->sendResponse($satisfactionGuaranteed, 'Satisfaction item updated successfully.');
    }

    /**
     * DELETE /api/satisfaction-guaranteed/{id}
     * Delete a record.
     */
    public function destroy(SatisfactionGuaranteed $satisfactionGuaranteed)
    {
        if ($satisfactionGuaranteed->icon) {
            ImageuploadHelper::removeImageFromDisk($satisfactionGuaranteed->icon);
        }
        $satisfactionGuaranteed->delete();
        return $this->sendResponse([], 'Satisfaction item deleted successfully.');
    }


}

<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AchievementController extends BaseController
{
    /**
     * GET /api/achievements
     * List all achievements with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Achievement::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $achievements = $query->latest()->paginate($perPage);

        return $this->sendResponse($achievements, 'Achievements retrieved successfully.');
    }

    /**
     * POST /api/achievements
     * Create a new achievement.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:achievements,title',
            'image' => 'nullable|image|max:2048',
            'countTxt' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        if ($request->hasFile('image')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'achievements');
            $data['image'] = $imageName['path'];
        }

        $achievement = Achievement::create($data);

        return $this->sendResponse($achievement, 'Achievement created successfully.');
    }

    /**
     * GET /api/achievements/{id}
     * Show a single achievement.
     */
    public function show(Achievement $achievement)
    {
        return $this->sendResponse($achievement, 'Achievement retrieved successfully.');
    }

    /**
     * PUT/PATCH /api/achievements/{id}
     * Update an existing achievement.
     */
    public function update(Request $request, Achievement $achievement)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:achievements,title,' . $achievement->id,
            'image' => 'nullable|image|max:2048',
            'countTxt' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        if ($request->hasFile('image')) {
            ImageuploadHelper::removeImageFromDisk($achievement->image);
            $imageName = ImageuploadHelper::uploadImage($request->file('image'), 'achievements');
            $data['image'] = $imageName['path'];
        }
        $achievement->update($data);

        return $this->sendResponse($achievement, 'Achievement updated successfully.');
    }

    /**
     * DELETE /api/achievements/{id}
     * Delete an achievement.
     */
    public function destroy(Achievement $achievement)
    {
        if ($achievement->image) {
            ImageuploadHelper::removeImageFromDisk($achievement->image);
        }
        $achievement->delete();

        return $this->sendResponse([], 'Achievement deleted successfully.');
    }

}

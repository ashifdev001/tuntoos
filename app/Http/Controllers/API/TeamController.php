<?php

namespace App\Http\Controllers\API;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Classes\ImageuploadHelper;

class TeamController extends BaseController
{
    /**
     * GET /api/teams
     * List all team members with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Team::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('position', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $teams = $query->latest()->paginate($perPage);

        return $this->sendResponse($teams, 'Team members retrieved successfully.');
    }

    /**
     * POST /api/teams
     * Store a new team member.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|unique:teams,name',
            'position' => 'required|string|max:255',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                $validator->errors()->first(),
                $validator->errors(),
                400
            );
        }

        $data = $validator->validated();
        $data['slug']  = Str::slug($data['name']);
        $data['image'] = null;

        if ($request->hasFile('image')) {
            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'teams');
            $data['image'] = $upload['path'];
        }

        $team = Team::create($data);

        return $this->sendResponse($team, 'Team member created successfully.');
    }

    /**
     * GET /api/teams/{id}
     * Display a single team member.
     */
    public function show(Team $team)
    {
        return $this->sendResponse($team, 'Team member retrieved successfully.');
    }

    /**
     * PUT /api/teams/{id}
     * Update a team member.
     */
    public function update(Request $request, Team $team)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255|unique:teams,name,' . $team->id,
            'position' => 'required|string|max:255',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->sendError(
                $validator->errors()->first(),
                $validator->errors(),
                400
            );
        }

        $team->name     = $request->name;
        $team->position = $request->position;
        $team->slug     = Str::slug($request->name);

        if ($request->hasFile('image')) {
            if ($team->image) {
                ImageuploadHelper::removeImageFromDisk($team->image);
            }

            $upload = ImageuploadHelper::uploadImage($request->file('image'), 'teams');
            $team->image = $upload['path'];
        }

        $team->save();

        return $this->sendResponse($team, 'Team member updated successfully.');
    }

    /**
     * DELETE /api/teams/{id}
     * Remove a team member.
     */
    public function destroy(Team $team)
    {
        if ($team->image) {
            ImageuploadHelper::removeImageFromDisk($team->image);
        }

        $team->delete();

        return $this->sendResponse([], 'Team member deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialLinkController extends BaseController
{
    /**
     * GET /api/social-links
     * List all social links with optional filtering by branch_id.
     */
    public function index(Request $request)
    {
        $query = SocialLink::with('branch');

        if ($request->has('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        $perPage = $request->get('per_page', 10);
        $links = $query->latest()->paginate($perPage);

        return $this->sendResponse($links, 'Social links retrieved successfully.');
    }

    /**
     * POST /api/social-links
     * Store a new social link.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|string|max:255',
            'icon'      => 'required|string|max:255',
            'link'      => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $link = SocialLink::create($validator->validated());

        return $this->sendResponse($link, 'Social link created successfully.');
    }

    /**
     * GET /api/social-links/{id}
     * Show a specific social link.
     */
    public function show(SocialLink $socialLink)
    {
        return $this->sendResponse($socialLink, 'Social link retrieved successfully.');
    }

    /**
     * PUT /api/social-links/{id}
     * Update a social link.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|string|max:255',
            'icon'      => 'required|string|max:255',
            'link'      => 'required|url|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $socialLink->update($validator->validated());

        return $this->sendResponse($socialLink, 'Social link updated successfully.');
    }

    /**
     * DELETE /api/social-links/{id}
     * Delete a social link.
     */
    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return $this->sendResponse([], 'Social link deleted successfully.');
    }

   
}

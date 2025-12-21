<?php

namespace App\Http\Controllers\API;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends BaseController
{
    /**
     * GET /api/jobs
     * Paginated, searchable list.
     */
    public function index(Request $request)
    {
        $query = Job::query();

        // Simple search on name or address
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $jobs = $query->latest()->paginate($perPage);

        return $this->sendResponse($jobs, 'Jobs retrieved successfully.');
    }

    /**
     * POST /api/jobs
     * Create a new branch.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:jobs,title',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }
        $data = $validator->validated();
        $data['slug'] = str_replace([' ', '-', '_'], '', $data['title']);
        $job = Job::create($data);

        return $this->sendResponse($job, 'Job created successfully.');
    }

    /**
     * GET /api/jobs/{id}
     * Show a single branch.
     */
    public function show(Job $job)
    {
        return $this->sendResponse($job, 'Job retrieved successfully.');
    }

    /**
     * PUT/PATCH /api/jobs/{id}
     * Update an existing Job.
     */
    public function update(Request $request, Job $job)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:jobs,name,' . $job->id,
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $job->update($validator->validated());

        return $this->sendResponse($job, 'Job updated successfully.');
    }

    /**
     * DELETE /api/jobs/{id}
     * Remove a branch.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return $this->sendResponse([], 'Job deleted successfully.');
    }
}

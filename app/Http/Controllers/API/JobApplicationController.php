<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends BaseController
{
    /**
     * GET /api/job-applications
     * Paginated, searchable list of applications.
     */
    public function index(Request $request)
    {
        $query = JobApplication::query();

        // Search by name, email, or phone
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstName', 'like', "%$search%")
                    ->orWhere('lastName', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $applications = $query->latest()->paginate($perPage);

        return $this->sendResponse($applications, 'Job applications retrieved successfully.');
    }

    /**
     * POST /api/job-applications
     * Store a new job application.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'job_id' => 'required|exists:jobs,id',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }
        $data = $validator->validated();
        if ($request->hasFile('resume')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('resume'), 'resumes', true, null, false);
            $data['resume'] = $imageName['path'];
        }

        $jobApplication = JobApplication::create($data);

        return $this->sendResponse($jobApplication, 'Job application submitted successfully.');
    }

    /**
     * GET /api/job-applications/{id}
     * Show a single job application.
     */
    public function show(JobApplication $jobApplication)
    {
        return $this->sendResponse($jobApplication, 'Job application retrieved successfully.');
    }

    /**
     * PUT/PATCH /api/job-applications/{id}
     * Update a job application.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:job_applications,email,' . $jobApplication->id,
            'phone' => 'required|string|max:20',
            'job_id' => 'required|exists:jobs,id',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $data = $validator->validated();
        if ($request->hasFile('resume')) {
            $imageName = ImageuploadHelper::uploadImage($request->file('resume'), 'resumes', true, null, false);
            $data['resume'] = $imageName['path'];
        }

        $jobApplication->update($data);

        return $this->sendResponse($jobApplication, 'Job application updated successfully.');
    }

    /**
     * DELETE /api/job-applications/{id}
     * Delete a job application.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return $this->sendResponse([], 'Job application deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\TrackingScripts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrackingScriptsController extends BaseController
{
    // GET /api/tracking-scripts
    public function index(Request $request)
    {
        $query = TrackingScripts::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('page', 'LIKE', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $scripts = $query->latest()->paginate($perPage);

        return $this->sendResponse($scripts, 'Tracking scripts fetched successfully');
    }

    // POST /api/tracking-scripts
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|string|max:255|unique:tracking_scripts,page',
            'script' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', 422, $validator->errors());
        }

        $script = TrackingScripts::create($request->only('page', 'script'));

        return $this->sendResponse($script, 'Tracking script created successfully');
    }

    // GET /api/tracking-scripts/{id}
    public function show($id)
    {
        $script = TrackingScripts::find($id);
        if (!$script) {
            return $this->sendError('Tracking script not found', 404);
        }

        return $this->sendResponse($script, 'Tracking script retrieved successfully');
    }

    // PUT /api/tracking-scripts/{id}
    public function update(Request $request, $id)
    {
        $script = TrackingScripts::find($id);
        if (!$script) {
            return $this->sendError('Tracking script not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'page' => 'required|string|max:255|unique:tracking_scripts,page,' . $script->id,
            'script' => 'required|string',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error', 422, $validator->errors());
        }

        $script->update($request->only('page', 'script'));

        return $this->sendResponse($script, 'Tracking script updated successfully');
    }

    // DELETE /api/tracking-scripts/{id}
    public function destroy($id)
    {
        $script = TrackingScripts::find($id);
        if (!$script) {
            return $this->sendError('Tracking script not found', 404);
        }

        $script->delete();

        return $this->sendResponse([], 'Tracking script deleted successfully');
    }
}

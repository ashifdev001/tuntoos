<?php

namespace App\Http\Controllers\API;

use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WhyChooseUsController extends BaseController
{
    /**
     * GET /api/why-choose-us
     * Paginated, searchable list.
     */
    public function index(Request $request)
    {
        $query = WhyChooseUs::query();

        // Search by title or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $items   = $query->latest()->paginate($perPage);

        return $this->sendResponse($items, 'Records retrieved successfully.');
    }

    /**
     * POST /api/why-choose-us
     * Create a new record.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255|unique:why_choose_us,title',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $item = WhyChooseUs::create($validator->validated());

        return $this->sendResponse($item, 'Record created successfully.');
    }

    /**
     * GET /api/why-choose-us/{id}
     * Show a single record.
     */
    public function show($whyChooseUs)
    {
        return $this->sendResponse(WhyChooseUs::findOrFail($whyChooseUs), 'Record retrieved successfully.');
    }

    /**
     * PUT/PATCH /api/why-choose-us/{id}
     * Update an existing record.
     */
    public function update(Request $request, $whyChooseUs)
    {
        $whyChooseUs = WhyChooseUs::findOrFail($whyChooseUs);
        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255|unique:why_choose_us,title,' . $whyChooseUs->id,
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $whyChooseUs->update($validator->validated());

        return $this->sendResponse($whyChooseUs, 'Record updated successfully.');
    }

    /**
     * DELETE /api/why-choose-us/{id}
     * Remove a record.
     */
    public function destroy($whyChooseUs)
    {
        WhyChooseUs::find($whyChooseUs)->delete();
        return $this->sendResponse([], 'Record deleted successfully.');
    }
}

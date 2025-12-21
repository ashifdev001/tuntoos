<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Mail\EnquiryMail;
use App\Models\Appointment;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends BaseController
{
    /**
     * GET /api/appointments
     * Display a listing of the appointments with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Appointment::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->get('per_page', 10);
        $appointments = $query->latest()->paginate($perPage);

        return $this->sendResponse($appointments, 'Appointments retrieved successfully.');
    }

    /**
     * POST /api/appointments
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            
            'service_category_id' => 'required|string',
            'message'    => 'nullable|string',
            'email'      => 'nullable|email',
            'location'      => 'nullable|string',
            'status'     => 'nullable|string|in:pending,confirmed,cancelled,completed',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $appointment = Appointment::create($validator->validated());
        Mail::to(env('ADMIN_EMAIL'))->send(new EnquiryMail([...$appointment->toArray(), "service" => ServiceCategory::find($request->service_category_id)->title]));
        return $this->sendResponse($appointment, 'Appointment created successfully.');
    }

    /**
     * GET /api/appointments/{id}
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        return $this->sendResponse($appointment, 'Appointment retrieved successfully.');
    }

    /**
     * PUT /api/appointments/{id}
     * Update the specified appointment in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'service_category_id' => 'required|string',
            'message'    => 'nullable|string',
            'status'     => 'nullable|string|in:pending,confirmed,cancelled,completed',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first(), $validator->errors(), 400);
        }

        $appointment->update($validator->validated());

        return $this->sendResponse($appointment, 'Appointment updated successfully.');
    }

    /**
     * DELETE /api/appointments/{id}
     * Remove the specified appointment from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return $this->sendResponse([], 'Appointment deleted successfully.');
    }
}

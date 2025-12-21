<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Log;
class EventController extends BaseController
{
   
    public function index(Request $request)
    {
        try {
            $perPage = $request->has('per_page') ? $request->per_page : 25;
            $events = Event::orderBy('id', 'desc');
            if (!empty($request->search)) {
                $events = $events->where('id', $request->search)
                    ->orWhere('title', 'LIKE', "$request->search%");
            }
            $events = $events->paginate($perPage);
            return $this->sendResponse($events, 'Events List.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);

            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'fees' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $event = Event::create($request->all());

        return $this->sendResponse($event, 'Event created successfully.');
    }

    public function show($id)
    {
        $event = Event::find($id);
        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }
        return $this->sendResponse($event, 'Event retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'fees' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $event = Event::find($id);
        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }

        $event->update($request->all());

        return $this->sendResponse($event, 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (is_null($event)) {
            return $this->sendError('Event not found.');
        }

        $event->delete();

        return $this->sendResponse([], 'Event deleted successfully.');
    }

}

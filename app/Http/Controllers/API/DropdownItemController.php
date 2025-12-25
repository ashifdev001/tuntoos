<?php

namespace App\Http\Controllers\API;

use App\Models\DropdownItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DropdownItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->has('per_page') ? $request->per_page : 25;
            $dropdownItems = DropdownItem::orderBy('id', 'desc');
            if (!empty($request->search)) {
                $dropdownItems = $dropdownItems->where('title', 'LIKE', "$request->search%");
            }
            $dropdownItems = $dropdownItems->paginate($perPage);
            return $this->sendResponse($dropdownItems, 'Dropdown Items List.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $dropdownItem = new DropdownItem();
            $dropdownItem->title = $request->title;
            $dropdownItem->save();

            return response()->json(['success' => true, "message" => 'Dropdown Item saved successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DropdownItem $dropdownItem)
    {
        try {
            return $this->sendResponse($dropdownItem->delete(), 'Dropdown Item deleted successfully.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }
}

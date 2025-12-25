<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Mail\EnquiryMail;
use App\Models\Enquiry;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsersController extends BaseController
{
    public function index(Request $request)
    {
        return 'Index';
    }

    public function getUsers(Request $request)
    {
        try {
            $per_page = 10;
            if ($request->has('per_page'))
                $per_page = $request->per_page;
            $userData = User::when($request->search, function ($query, $search) {
                $query->where('id', $search);
            })->orderBy('id', 'desc')->paginate($per_page);
            foreach ($userData as $key => &$user) {
                $user['image'] = '<img src="' . Storage::disk('public')->url($user->image) . '" class="" alt="User Image" style="width: 40px;">';
                $user['action'] = '<div class="btn-group">' .
                    '<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' .
                    '<i class="fa fa-cog" aria-hidden="true"></i>' .
                    '</button>' .
                    '<div class="dropdown-menu">' .
                    '<a class="dropdown-item user_edit" data-user-edit="' . $user->id . '" href="#"><i class="fas fa-edit"></i> Edit</a>' .
                    '<a class="dropdown-item user_delete" data-user-delete="' . $user->id . '" href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>' .
                    '</div>' .
                    '</div>';
            }
            return $this->sendResponse($userData, 'User List.');
        } catch (\Throwable $e) {
            return $this->sendError('Something went wrong!');
        }
    }

    public function userProfile(Request $request)
    {
        try {
            $userData = User::find(Auth::user()->id);
            // create user image full path
            $userData->image = Storage::disk('public')->url($userData->image);
            return $this->sendResponse($userData, 'User List.');
        } catch (\Throwable $e) {
            return $this->sendError('User List.');
        }
    }

    public function profileimgUpdate(Request $request)
    {
        $user = Auth::user();
        $path = '/uploads/profile_images/';
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image');
            $imageName = uniqid() . '_' . $imagePath->getClientOriginalName();
            Storage::disk('public')->put($path . $imageName, file_get_contents($request->file('image')));
        }

        $user->image = $path . $imageName;
        if ($user->save()) {
            return $this->sendResponse([], 'Profile Image Updated successfully!');
        }
        return $this->sendError('Something went wrong!');
    }

    public function userRoles(Request $request)
    {
        return 'user roles';
    }

    public function enquiries(Request $request)
    {
        try {
            $perPage = $request->has('per_page') ? $request->per_page : 25;
            $enquiries = Enquiry::orderBy('id', 'desc');
            if (!empty($request->search)) {
                $enquiries = $enquiries->where('id', $request->search)
                    ->orWhere('name', 'LIKE', "$request->search%")
                    ->orWhere('email', 'LIKE', "$request->search%")
                    ->orWhere('phone', 'LIKE', "$request->search%");
            }
            $enquiries = $enquiries->paginate($perPage);
            return $this->sendResponse($enquiries, 'Enquiries List.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }

    function enquiryDelete(Enquiry $enquiry)
    {
        try {
            return $this->sendResponse($enquiry->delete(), 'Enquiry deleted successfully.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function payments(Request $request)
    {
        try {
            $perPage = $request->has('per_page') ? $request->per_page : 25;
            $payments = Payment::orderBy('id', 'desc');
            if (!empty($request->search)) {
                $payments = $payments->where('id', $request->search)
                    ->orWhere('first_name', 'LIKE', "$request->search%")
                    ->orWhere('last_name', 'LIKE', "$request->search%")
                    ->orWhere('email', 'LIKE', "$request->search%")
                    ->orWhere('phone', 'LIKE', "$request->search%");
            }
            $payments = $payments->paginate($perPage);
            return $this->sendResponse($payments, 'Payments List.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }

    function paymentDelete(Payment $payment)
    {
        try {
            return $this->sendResponse($payment->delete(), 'Payment deleted successfully.');
        } catch (\Exception $e) {
            Log::debug([
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            return $this->sendError('Something went wrong!', $e);
        }
    }

    public function saveEnq(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'enq_for' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            $enquiry = new Enquiry();
            $enquiry->name = $request->name;
            $enquiry->email = $request->email;
            $enquiry->phone = $request->phone;
            $enquiry->subject = $request->subject;
            $enquiry->message = $request->message;
            $enquiry->enq_for = $request->enq_for;
            $enquiry->state = $request->state;
            $enquiry->city = $request->city;
            $enquiry->save();

            Mail::to(env('ADMIN_EMAIL'))->send(new EnquiryMail([
                ...$enquiry->toArray(),
                "service" => "General Enquiry"
            ]));
            return response()->json(['success' => true, "message" => 'Enquiry saved successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => $e->getMessage()], 500);
        }
    }
}

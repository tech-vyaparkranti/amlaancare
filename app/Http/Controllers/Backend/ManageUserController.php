<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreatedMail;
use App\Models\User;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManageUserController extends Controller
{
    public function index()
    {
        return view('admin.manage-user.index');
    }

    public function create(Request $request)
    {
        // Ensure the email is trimmed and lowercased for uniqueness check
        $request->merge([
            'email' => strtolower(trim($request->email))
        ]);

        // Validate the email to check if it already exists in the 'users' table
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required','digits:10','unique:users,phone'],
        ]);

        // Begin a transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Create the user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = $request->role;
            $user->phone = $request->phone;
            $user->status = 'active';
            $user->save();

            // Log user creation
            Log::info('User created with ID: ' . $user->id);

            // Only create the vendor if the role is 'vendor'
            if ($request->role === 'vendor') {

                // Use the user's ID for the vendor
                $userId = $user->id;  // Use the ID of the created user

                // Create the vendor with user_id
                $this->createVendor($request, $userId);

                // Log vendor creation
                Log::info('Vendor created for user ID: ' . $userId);
    // dd($user);
                // Send account creation email
                $mailResponse =  $this->sendEmail($request);
                // Commit the transaction
                DB::commit();

                toastr('Created Successfully! '.$mailResponse, 'success', 'success');
            } else {
                toastr('Invalid role!', 'error', 'error');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Error: ' . $e->getMessage());

            toastr('Something went wrong, please try again.', 'error', 'error');
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }
    public function sendEmail(Request $request){
        try{
            Mail::to($request->email)->send(new AccountCreatedMail($request->name, $request->phone, $request->password));
            return "Notification email sent.";
        }catch(Exception $exception){
            report($exception);
            return $exception->getMessage();
        }


    }
    private function createVendor(Request $request, $userId)
    {
        // Create the vendor
        $vendor = new Vendor();
        $vendor->banner = 'uploads/1343.jpg'; // Default banner
        $vendor->shop_name = $request->shop_name;
        $vendor->phone = $request->phone;
        $vendor->email = $request->email;
        $vendor->address = $request->address;
        $vendor->city = $request->city;
        $vendor->state = $request->state;
        $vendor->country = $request->country;
        $vendor->pincode = $request->pincode;
        $vendor->pickup_location = $request->pickup_location;
        $vendor->description = 'shop description'; // Default description
        $vendor->user_id = $userId; // Assign the user_id from the created user
        $vendor->status = 1; // Active vendor by default

        // Save the vendor
        $vendor->save();

        return $vendor;
    }
}

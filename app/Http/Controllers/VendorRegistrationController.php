<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorRegistrationForm;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15',
            'email' => 'required|email|unique:vendor_registrations,email',
            'gstin' => 'nullable|string|max:15',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
            'bank_account_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:20',
            'ifsc_code' => 'required|string|max:11',
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'cancelled_cheque' => 'required|file',
            'gst_certificate' => 'required|file',
            'password' => 'required|string|confirmed|min:8',
            // 'video_blob' => 'required',
        ]);

        $cancelledChequePath = $request->file('cancelled_cheque')->store('uploads', 'public');
        $gstCertificatePath = $request->file('gst_certificate')->store('uploads', 'public');

        // $videoData = base64_decode(preg_replace('#^data:video/\w+;base64,#i', '', $request->video_blob));
        // $videoPath = 'uploads/videos/' . uniqid() . '.mp4';
        // Storage::disk('public')->put($videoPath, $videoData);

        VendorRegistrationForm::create([
            'full_name' => $request->full_name,
            'business_name' => $request->business_name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'gstin' => $request->gstin,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'bank_account_name' => $request->bank_account_name,
            'bank_account_number' => $request->bank_account_number,
            'ifsc_code' => $request->ifsc_code,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cancelled_cheque' => $cancelledChequePath,
            'gst_certificate' => $gstCertificatePath,
            // 'video_path' => $videoPath,
            'password' => Hash::make($request->password),
            'whatsapp_consent' => $request->has('whatsapp_consent'),
            'status' => 'pending', // Default status is 'pending'
        ]);

        return redirect()->back()->with('success', 'Request Send successfully!');
    }
}

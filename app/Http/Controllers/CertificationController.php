<?php
namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    // Manage Certifications (Display Page)
    public function manageCertifications()
    {
        // Fetch all certifications from the database
        $certifications = Certification::all();
        // Pass the certifications data to the view
        return view('admin.manage-certification', compact('certifications'));
    }

    // Store or Update Certification
    public function store(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:active,inactive',
            'serial' => 'required|integer',
        ]);

        // Handling the image upload if it exists in the request
        if ($request->hasFile('image')) {
            // Store the image in the 'public/certifications' directory
            $imageName = $request->image->store('certifications', 'public');
            $data['image'] = $imageName;
        }

        // Check if it's an update or a new certification
        if ($request->certification_id) {
            // Update an existing certification
            $certification = Certification::findOrFail($request->certification_id);
            $certification->update($data);
            return redirect()->route('manageCertifications')->with('status', 'Certification updated successfully');
        } else {
            // Create a new certification
            Certification::create($data);
            return redirect()->route('manageCertifications')->with('status', 'Certification created successfully');
        }
    }

    // Fetch certification data for editing
    public function edit($id)
    {
        // Fetch the certification by ID
        $certification = Certification::findOrFail($id);
        // Return the certification data in JSON format for editing
        return response()->json(['certification' => $certification]);
    }
    // Toggle certification status (Active/Inactive)
    public function toggleStatus($id)
    {
        // Fetch the certification by ID
        $certification = Certification::findOrFail($id);
        // Toggle the status between active and inactive
        $certification->status = $certification->status == 'active' ? 'inactive' : 'active';
        // Save the changes to the database
        $certification->save();
        // Redirect back with success message
        return redirect()->route('manageCertifications')->with('status', 'Certification status updated');
    }
}

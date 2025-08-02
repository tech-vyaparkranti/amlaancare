<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePageDetail;

class ManageHomeController extends Controller
{
    // Display Home Page Details
    public function manageHome()
    {
        // Fetch all the home page details from the database
        $homePageDetails = HomePageDetail::all();

        // Pass the data to the view
        return view('admin.manage-home', compact('homePageDetails'));
    }

    // Store Home Page Details
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'about_us_images' => 'nullable|array', // Ensure this is an array of files
            'about_us_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image for about us
            'about_us_short_description' => 'nullable|string',
            'founder_name' => 'required|string|max:255',
            'founder_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message_from_founder' => 'nullable|string',
            'desktop_video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // Validate desktop video file type and size
            'mobile_video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // Validate mobile video file type and size
        ]);

        // Handle about us images (multiple images)
        $about_us_images = [];
        if ($request->hasFile('about_us_images')) {
            foreach ($request->file('about_us_images') as $image) {
                $about_us_images[] = $image->store('about_us', 'public'); // Save each image to the 'about_us' folder
            }
        }

        // Handle other image uploads (founder image)
        $founder_image = $request->file('founder_image') ? $request->file('founder_image')->store('images', 'public') : null;

        // Handle video uploads (desktop_video and mobile_video)
        $desktop_video = $request->file('desktop_video') ? $request->file('desktop_video')->store('videos', 'public') : null;
        $mobile_video = $request->file('mobile_video') ? $request->file('mobile_video')->store('videos', 'public') : null;

        // Insert data into the database
        HomePageDetail::create([
            'about_us_images' => json_encode($about_us_images), // Store about us images as JSON
            'about_us_short_description' => $request->about_us_short_description,
            'founder_name' => $request->founder_name,
            'founder_image' => $founder_image,
            'message_from_founder' => $request->message_from_founder,
            'desktop_video' => $desktop_video, // Save the desktop video path
            'mobile_video' => $mobile_video,   // Save the mobile video path
            'status' => 'enabled',  // Default to 'enabled'
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Home Page Details added successfully!');
    }

    // Edit Home Page Details
    public function edit($id)
    {
        // Fetch the specific HomePageDetail by ID
        $homePageDetail = HomePageDetail::find($id);

        // Check if the record exists before passing to the view
        if (!$homePageDetail) {
            return redirect()->route('home.page.index')->with('error', 'Home Page Detail not found');
        }

        // Pass the record to the view for editing
        return view('admin.manage-home', compact('homePageDetail'));
    }

    // Update Home Page Details
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'about_us_images' => 'nullable|array',
            'about_us_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_us_short_description' => 'nullable|string',
            'founder_name' => 'required|string|max:255',
            'founder_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message_from_founder' => 'nullable|string',
            'desktop_video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // Validate desktop video file type and size
            'mobile_video' => 'nullable|mimes:mp4,avi,mkv|max:10240', // Validate mobile video file type and size
        ]);

        // Find the HomePageDetail by ID
        $homePageDetail = HomePageDetail::findOrFail($id);

        // Handle file uploads (about_us_images, founder_image, videos)
        if ($request->hasFile('about_us_images')) {
            foreach ($request->file('about_us_images') as $image) {
                $about_us_images[] = $image->store('images', 'public');
            }
            $homePageDetail->about_us_images = json_encode($about_us_images);
        }

        if ($request->hasFile('founder_image')) {
            $homePageDetail->founder_image = $request->file('founder_image')->store('images', 'public');
        }

        // Handle video uploads (desktop_video and mobile_video)
        if ($request->hasFile('desktop_video')) {
            $homePageDetail->desktop_video = $request->file('desktop_video')->store('videos', 'public');
        }

        if ($request->hasFile('mobile_video')) {
            $homePageDetail->mobile_video = $request->file('mobile_video')->store('videos', 'public');
        }

        // Update the remaining fields
        $homePageDetail->about_us_short_description = $request->about_us_short_description;
        $homePageDetail->founder_name = $request->founder_name;
        $homePageDetail->message_from_founder = $request->message_from_founder;

        // Save the changes
        $homePageDetail->save();

        // Redirect back with success message
        return redirect()->route('manageHome', $homePageDetail->id)->with('success', 'Home Page Details updated successfully!');
    }

    // Toggle the status of a HomePageDetail
    public function toggleStatus($id)
    {
        // Fetch the HomePageDetail by ID
        $homePageDetail = HomePageDetail::findOrFail($id);

        // Toggle the status
        $homePageDetail->status = $homePageDetail->status == 'enabled' ? 'disabled' : 'enabled';
        $homePageDetail->save();

        // Return the updated record (optional for AJAX response)
        return redirect()->back()->with('success', 'Home Page Detail status updated successfully!');
    }
}

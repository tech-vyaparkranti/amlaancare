<?php

namespace App\Http\Controllers;

use App\Models\SupplyChain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplyChainController extends Controller
{
    // Display Supply Chain Details
    public function manageSupplyChain()
{
    // Fetch all supply chain content from the database
    $supplyChainDetails = SupplyChain::all();

    // Pass the data to the view
    return view('admin.manage-supply', compact('supplyChainDetails'));
}


    // Store Supply Chain Details
    public function store(Request $request)
{
    // Validate the incoming data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'faq' => 'required|array',
        'faq.*.question' => 'required|string',
        'faq.*.answer' => 'required|string',
    ]);

    // Store FAQ as JSON
    $faqData = json_encode($request->faq);

    // Handle image uploads (multiple images)
    $image = null;
    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('supply_images', 'public');
    }

    // Insert data into the database
    SupplyChain::create([
        'image' => $image,
        'title' => $request->title,
        'content' => $request->content,
        'faq' => $faqData,  // Store FAQ as JSON
        'status' => 'active',  // Default to 'enabled'
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Supply Chain Content added successfully!');
}



    // Edit Supply Chain Details
    public function edit($id)
{
    // Fetch the specific SupplyChain by ID
    $supplyChainDetail = SupplyChain::find($id); // Use find() to avoid exception on failure

    // Check if the record exists before passing to the view
    if (!$supplyChainDetail) {
        return redirect()->route('manageSupplyChain')->with('error', 'Supply Chain Content not found');
    }

    // Decode the FAQ from JSON to pass it back as an array
    $faqData = json_decode($supplyChainDetail->faq);

    // Pass the record and faq data to the view for editing
    return view('admin.manage-supply', compact('supplyChainDetail', 'faqData'));
}


    // Update Supply Chain Details
    public function update(Request $request, $id)
{
    // Validate the incoming data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'faq' => 'required|array',
        'faq.*.question' => 'required|string',
        'faq.*.answer' => 'required|string',
    ]);

    // Find the SupplyChain by ID
    $supplyChainDetail = SupplyChain::findOrFail($id);

    // Handle image uploads (only if a new image is uploaded)
    if ($request->hasFile('image')) {
        // Delete the old image if exists
        if (Storage::exists('public/' . $supplyChainDetail->image)) {
            Storage::delete('public/' . $supplyChainDetail->image);
        }

        // Store the new image
        $image = $request->file('image')->store('supply_images', 'public');
        $supplyChainDetail->image = $image; // Update the image path
    }

    // Update other fields
    $supplyChainDetail->title = $request->title;
    $supplyChainDetail->content = $request->content;
    $supplyChainDetail->faq = json_encode($request->faq);  // Update FAQ (store as JSON)

    // Save the updated data
    $supplyChainDetail->save();

    // Redirect back with success message
    return redirect()->route('manageSupplyChain')->with('success', 'Supply Chain Content updated successfully!');
}


    // Toggle the status of a SupplyChain
    public function toggleStatus($id)
    {
        // Fetch the SupplyChain by ID
        $supplyChainDetail = SupplyChain::findOrFail($id);

        // Toggle the status
        $supplyChainDetail->status = $supplyChainDetail->status == 'active' ? 'disabled' : 'active';
        $supplyChainDetail->save();

        // Return the updated record (optional for AJAX response)
        return redirect()->back()->with('success', 'Supply Chain Content status updated successfully!');
    }

    // Delete Supply Chain Content (optional)
    public function destroy($id)
    {
        // Find the SupplyChain by ID
        $supplyChainDetail = SupplyChain::findOrFail($id);

        // Delete associated images if they exist
        if ($supplyChainDetail->images) {
            $images = json_decode($supplyChainDetail->images);
            foreach ($images as $image) {
                if (Storage::exists('public/' . $image)) {
                    Storage::delete('public/' . $image);
                }
            }
        }

        // Delete the content from the database
        $supplyChainDetail->delete();

        // Redirect back with success message
        return redirect()->route('supply.chain.index')->with('success', 'Supply Chain Content deleted successfully!');
    }
}

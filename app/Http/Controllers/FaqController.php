<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Method to manage FAQs (this could display the manageFAQ view)
    public function index()
    {
        // Fetch all FAQ data from the database
        $faqDetails = Faq::all(); 
    
        // Optionally, pass the faqData if editing a specific FAQ
        $faqData = request()->get('faqData') ?? null;
    
        // Pass the FAQs to the view
        return view('admin.manageFAQ', compact('faqDetails', 'faqData'));
    }


    // Method to store new FAQ data
    public function store(Request $request)
{
    // Validate the request
    $data = $request->validate([
        'faq' => 'array',
        'faq.*.question' => 'required|string',
        'faq.*.answer' => 'required|string',
        'status' => 'required|in:enabled,disabled',
    ]);

    // Create a new FAQ record
    $faq = new Faq();
    $faq->status = $data['status'];
    $faq->faq = json_encode($data['faq']); // Store the FAQ as a JSON string
    $faq->save();

    // Redirect to the FAQ index (manageFAQ view)
    return redirect()->route('faq.index')->with('success', 'FAQ added successfully');
}


    // Method to update an existing FAQ
    public function update(Request $request, $id)
{
    // Validate the request
    $data = $request->validate([
        'faq' => 'array',
        'faq.*.question' => 'required|string',
        'faq.*.answer' => 'required|string',
        'status' => 'required|in:enabled,disabled',
    ]);

    // Find the FAQ record by ID
    $faq = Faq::findOrFail($id);

    // Update the FAQ data
    $faq->status = $data['status'];
    $faq->faq = json_encode($data['faq']); // Store FAQ as JSON
    $faq->save();

    // Redirect to the FAQ index (manageFAQ view)
    return redirect()->route('faq.index')->with('success', 'FAQ updated successfully');
}


public function edit($id)
{
    // Fetch the FAQ record by ID
    $faqDetail = Faq::findOrFail($id);

    // Decode the JSON to get the FAQ questions and answers
    $faqData = json_decode($faqDetail->faq, true);  // Convert to array

    // Check if FAQ data is countable before using count()
    if (is_array($faqData) && count($faqData) > 0) {
        // Pass the FAQ data to the view
        return view('admin.manageFAQ', compact('faqDetail', 'faqData'));
    } else {
        // Handle the case where FAQ data is empty or invalid
        return view('admin.manageFAQ', compact('faqDetail'))->with('error', 'No FAQ data available.');
    }
}


    // Method to disable a FAQ (change status to 'disabled')
    public function disable($id)
    {
        // Find the FAQ record by ID
        $faq = Faq::findOrFail($id);

        // Update the status to 'disabled'
        $faq->status = 'disabled';
        $faq->save();

        // Return a JSON response indicating success
        return response()->json(['success' => 'FAQ disabled successfully']);
    }

    // Optionally, you can create a method to enable a FAQ (change status to 'enabled')
    public function enable($id)
    {
        // Find the FAQ record by ID
        $faq = Faq::findOrFail($id);

        // Update the status to 'enabled'
        $faq->status = 'enabled';
        $faq->save();

        // Return a JSON response indicating success
        return response()->json(['success' => 'FAQ enabled successfully']);
    }
    public function toggleStatus($id)
{
    $faq = Faq::findOrFail($id);

    // Toggle the status between 'enabled' and 'disabled'
    $faq->status = ($faq->status == 'enabled') ? 'disabled' : 'enabled';
    $faq->save();

    return redirect()->route('faq.index')->with('success', 'FAQ status toggled successfully');
}

}

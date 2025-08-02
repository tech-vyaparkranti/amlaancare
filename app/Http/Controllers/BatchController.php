<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;

class BatchController extends Controller
{
    // Show the Batch Tracking Form
    public function showBatchTrackingForm()
    {
        return view('frontend.pages.batch-track'); // Show the form to track batch
    }

    public function manageBatch()
    {
        // Fetch all the home page details from the database
        $batchDetails = Batch::all();

        // Pass the data to the view
        return view('admin.manage-Batch', compact('batchDetails'));
    }


    // Track the Batch based on batch number
    public function trackBatch(Request $request)
    {
        // Validate the batch_number input
        $request->validate([
            'batch_number' => 'required|string|exists:batches,batch_number', // Check if batch number exists
        ]);
    
        // Retrieve the batch based on batch_number
        $batchNumber = $request->input('batch_number');
        $batch = Batch::where('batch_number', $batchNumber)->first();
    
        // If batch exists, return the batch details to the view
        if ($batch) {
            $batchDetails = [
                'batch_number' => $batch->batch_number,
                'batch_name' => $batch->batch_name,
                'start_date' => $batch->start_date,
                'pdf_url' => $batch->pdf_url, // Link to the PDF
            ];
    
            return view('frontend.pages.batch-track', compact('batchDetails'));
        } else {
            // If batch does not exist, show an error message
            return view('frontend.pages.batch-track', ['errorMessage' => 'Batch not found.']);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'batch_number' => 'required|unique:batches,batch_number',
            'batch_name' => 'required|string',
            'start_date' => 'required|date',
            'pdf_url' => 'nullable|mimes:pdf|max:10240', // PDF validation
        ]);

        $batch = new Batch();
        $batch->batch_number = $request->batch_number;
        $batch->batch_name = $request->batch_name;
        $batch->start_date = $request->start_date;

        if ($request->hasFile('pdf_url')) {
$batch->pdf_url = $request->file('pdf_url')->store('uploads/batches', 'public');
        }

        $batch->save();

        return redirect()->route('manageBatch')->with('success', 'Batch details added successfully!');
    }

    // Show the Batch Edit form
public function edit($id)
{
    $batch = Batch::findOrFail($id);

    // Return the data as JSON for AJAX requests
    return response()->json([
        'batch_number' => $batch->batch_number,
        'batch_name' => $batch->batch_name,
        'start_date' => $batch->start_date,
        'pdf_url' => $batch->pdf_url, // Or any other data you want to send back
    ]);
}

public function destroy($id)
{
    $batch = Batch::findOrFail($id);
    $batch->delete();

    return redirect()->route('manageBatch')->with('success', 'Batch deleted successfully!');
}
    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_number' => 'required|unique:batches,batch_number,' . $id,
            'batch_name' => 'required|string',
            'start_date' => 'required|date',
            'pdf_url' => 'nullable|mimes:pdf|max:10240',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->batch_number = $request->batch_number;
        $batch->batch_name = $request->batch_name;
        $batch->start_date = $request->start_date;

        if ($request->hasFile('pdf_url')) {
            // Delete old file if it exists
            if ($batch->pdf_url) {
                Storage::delete($batch->pdf_url);
            }
            $batch->pdf_url = $request->file('pdf_url')->store('uploads/batches');
        }

        $batch->save();

        return redirect()->route('manageBatch')->with('success', 'Batch details updated successfully!');
    }

    public function toggleStatus($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->status = ($batch->status == 'enabled') ? 'disabled' : 'enabled';
        $batch->save();

        return redirect()->route('admin.manage-Batch')->with('success', 'Batch status updated successfully!');
    }
}

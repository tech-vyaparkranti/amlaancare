<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserExit;
use Illuminate\Support\Facades\Log;
use App\DataTables\ExitCustomerDataTable;


class ExitTrackerController extends Controller
{
    public function trackExit(Request $request)
    {
        // Optional: Debug the session data to verify 'current_page' is set correctly
        // Log::info('Session Data:', session()->all());
        // dd(session('current_page')); // You can use this to check if the session value exists

        // Validate the URL received from the frontend
        $data = $request->validate([
            'url' => 'required|url',
        ]);

        // Optionally, track the user if logged in (set user_id to null for non-logged-in users)
        $userId = auth()->user() ? auth()->user()->id : null;

        // If the session 'current_page' exists, you can track the previous page before exit
        $previousPage = session('current_page', 'Unknown');  // Default to 'Unknown' if not set

        // Store the exit data into the database
        UserExit::create([
            'user_id' => $userId,           // Store user ID (or null if not logged in)
            'url' => $data['url'],          // Store the exit URL that the user leaves
            'timestamp' => now(),           // Timestamp when the exit occurs
        ]);

        // Optionally, log the exit data for debugging
        Log::info('User exit tracked:', [
            'user_id' => $userId,
            'exit_url' => $data['url'],
            'previous_page' => $previousPage
        ]);

        // Return a success response
        return response()->json(['message' => 'Exit tracked successfully']);
    }

    public function exiturl(ExitCustomerDataTable $dataTable)
    {
        return $dataTable->render('admin.customer-list.exituser');
    }
}

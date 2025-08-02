<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Create a new lead record
        Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json(['message' => 'Lead saved successfully!']);
    }
}

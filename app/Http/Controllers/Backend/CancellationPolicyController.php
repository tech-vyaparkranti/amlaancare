<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\CancellationPolicy;
use App\Http\Controllers\Controller;

class CancellationPolicyController extends Controller
{
    public function index()
    {
        $content = CancellationPolicy::first();
        return view('admin.cancellationPolicy.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        CancellationPolicy::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        toastr('updated successfully!', 'success', 'success');

        return redirect()->back();

    }
    
}

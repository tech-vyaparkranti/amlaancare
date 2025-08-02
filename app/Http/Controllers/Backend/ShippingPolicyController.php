<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\shippingPolicy;
use Illuminate\Http\Request;

class ShippingPolicyController extends Controller
{
    public function index()
    {
        $content = shippingPolicy::first();
        return view('admin.shippingPolicy.index', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'content' => ['required']
        ]);

        shippingPolicy::updateOrCreate(
            ['id' => 1],
            [
                'content' => $request->content
            ]
        );

        toastr('updated successfully!', 'success', 'success');

        return redirect()->back();

    }
    
}

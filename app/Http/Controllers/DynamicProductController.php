<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DynamicProduct; // Make sure to use the correct model

class ProductController extends Controller
{
    public function index()
    {
        // Fetch products with status 'active' from the dynamic.products table
        $products = DynamicProduct::all();

        // Pass the fetched products to the view
        return view('home.blade', compact('products')); // Pass 'products' to the view, not 'dynamic.products'
    }
}

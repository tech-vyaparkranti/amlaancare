<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FontMasterDataTable;
use App\Http\Controllers\Controller;
use App\Models\FontMaster;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FontMasterController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(FontMasterDataTable $dataTable)
    {
        return $dataTable->render('admin.product.font-master.manageFontMaster');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.font-master.createFontMaster');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'font_sample_image' => ['required', 'image', 'max:1000','dimensions:ratio=1/1'],
            'font_name' => ['required', 'max:200','unique:font_master,font_name'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'font_sample_image', 'uploads/fonts_images');
        $font = new FontMaster();
        $font->font_name = $request->font_name;
        $font->font_sample_image = $imagePath;
        $font->status = $request->status;        
        $font->created_by = Auth::user()->id;
        $font->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.font-master.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fontMaster = FontMaster::findOrFail($id);
        return view('admin.product.font-master.editFontMaster', compact('fontMaster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        
        $request->validate([
            'font_sample_image' => ['nullable', 'image', 'max:1000','dimensions:ratio=1/1'],
            'font_name' => ['required', 'max:200','unique:font_master,font_name,except,id'],
            'status' => ['required']
        ]);

        $font = FontMaster::findOrFail($id);


        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'font_sample_image', 'uploads/fonts_images');
        $font->font_name = $request->font_name;
        $font->font_sample_image = empty(!$imagePath) ? $imagePath : $font->font_sample_image;
        $font->status = $request->status;
        
        $font->updated_by = Auth::user()->id;
        $font->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.font-master.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $font = FontMaster::findOrFail($id);
        $font->status = 0;
        $font->save();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}

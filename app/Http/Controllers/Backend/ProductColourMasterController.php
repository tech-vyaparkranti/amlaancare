<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductColourDataTable;
use App\Http\Controllers\Controller;
use App\Models\ProductColourMaster;
use App\Models\ProductColours;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductColourMasterController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductColourDataTable $dataTable)
    {
        
        return $dataTable->render('admin.product.product-colour-master.manageProductColourMaster');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-colour-master.createProductColourMaster');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'colour_sample_image' => ['required', 'image', 'max:1000','dimensions:ratio=1/1'],
            'colour_name' => ['required', 'max:200','unique:product_colour_master,colour_name'],
            'status' => ['required'],
            ProductColourMaster::TYPE=>["required"]
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'colour_sample_image', 'uploads/product_colour_images');
        $object = new ProductColourMaster();
        $object->colour_name = $request->colour_name;
        $object->colour_sample_image = $imagePath;
        $object->status = $request->status;
        $object->{ProductColourMaster::TYPE} = $request->{ProductColourMaster::TYPE};
        $object->created_by = Auth::user()->id;
        $object->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.product-colour-master.index');
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
        $productColourMaster = ProductColourMaster::findOrFail($id);
        return view('admin.product.product-colour-master.editProductColourMaster', compact('productColourMaster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {        
        $request->validate([
            'colour_sample_image' => ['nullable', 'image', 'max:1000','dimensions:ratio=1/1'],
            'colour_name' => ['required', 'max:200','unique:product_colour_master,colour_name,except,id'],
            'status' => ['required'],
            ProductColourMaster::TYPE=>"required"
        ]);

        $object = ProductColourMaster::findOrFail($id);


        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'colour_sample_image', 'uploads/fonts_images');
        $object->colour_name = $request->colour_name;
        $object->colour_sample_image = empty(!$imagePath) ? $imagePath : $object->colour_sample_image;
        $object->status = $request->status;
        $object->{ProductColourMaster::TYPE} = $request->{ProductColourMaster::TYPE};
        $object->updated_by = Auth::user()->id;
        $object->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.product-colour-master.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $object = ProductColourMaster::findOrFail($id);
        $object->status = 0;
        $object->save();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}

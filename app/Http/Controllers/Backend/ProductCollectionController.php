<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Models\ProductCollectionMasterModel;
use App\DataTables\ProductCollectionDataTable;
use App\Models\CollectionProductsMappingModel;

class ProductCollectionController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductCollectionDataTable $dataTable)
    {
        return $dataTable->render('admin.product.product-collection.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-collection.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'collection_image' => ['required', 'image', 'max:3000'],
            'collection_name' => ['required', 'max:500','unique:product_collection_master,collection_name'],
            'sort_number' => ['nullable','integer','gte:1'],
            'status' => ['required',"in:1,0"],
            'text' => ['required','string'],
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, ProductCollectionMasterModel::COLLECTION_IMAGE, 'uploads/image_collection');
        if(empty($request->{ProductCollectionMasterModel::SORT_NUMBER})){
            $request->{ProductCollectionMasterModel::SORT_NUMBER} = ProductCollectionMasterModel::max(ProductCollectionMasterModel::SORT_NUMBER)+10;
        }
        $productCollection = new ProductCollectionMasterModel();
        $productCollection->{ProductCollectionMasterModel::COLLECTION_IMAGE} = $imagePath;
        $productCollection->{ProductCollectionMasterModel::COLLECTION_NAME} = $request->{ProductCollectionMasterModel::COLLECTION_NAME};
        $productCollection->{ProductCollectionMasterModel::SORT_NUMBER} = $request->{ProductCollectionMasterModel::SORT_NUMBER};
        $productCollection->{ProductCollectionMasterModel::STATUS} = $request->{ProductCollectionMasterModel::STATUS};
        $productCollection->{ProductCollectionMasterModel::TEXT} = $request->{ProductCollectionMasterModel::TEXT};

        $productCollection->save();
        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.product-collections.index');
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
        $productCollection = ProductCollectionMasterModel::findOrFail($id);
        return view('admin.product.product-collection.edit',compact('productCollection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $request->validate([
            'collection_image' => ['nullable', 'image', 'max:3000'],
            'collection_name' => ['required', 'max:500','unique:product_collection_master,collection_name'],
            'sort_number' => ['nullable','integer','gte:1'],
            'status' => ['required',"in:1,0"],
            'text' => ['required'],
        ]);
        $productCollection = ProductCollectionMasterModel::findOrFail($id);

        if($request->hasFile(ProductCollectionMasterModel::COLLECTION_IMAGE)){
            /** Handle the image upload */
            $imagePath = $this->updateImage($request, ProductCollectionMasterModel::COLLECTION_IMAGE, 'uploads/image_collection',$productCollection->{ProductCollectionMasterModel::COLLECTION_IMAGE});
        }else{
            $imagePath = $productCollection->{ProductCollectionMasterModel::COLLECTION_IMAGE};
        }
        
        if(empty($request->{ProductCollectionMasterModel::SORT_NUMBER})){
            $request->{ProductCollectionMasterModel::SORT_NUMBER} = ProductCollectionMasterModel::max(ProductCollectionMasterModel::SORT_NUMBER)+10;
        }
        $productCollection->{ProductCollectionMasterModel::COLLECTION_IMAGE} = $imagePath;
        $productCollection->{ProductCollectionMasterModel::COLLECTION_NAME} = $request->{ProductCollectionMasterModel::COLLECTION_NAME};
        $productCollection->{ProductCollectionMasterModel::SORT_NUMBER} = $request->{ProductCollectionMasterModel::SORT_NUMBER};
        $productCollection->{ProductCollectionMasterModel::STATUS} = $request->{ProductCollectionMasterModel::STATUS};
        $productCollection->{ProductCollectionMasterModel::TEXT} = $request->{ProductCollectionMasterModel::TEXT};

        
        $productCollection->save();
        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.product-collections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeStatus(Request $request)
    {
        $check = ProductCollectionMasterModel::findOrFail($request->id);
        $check->status = $request->status == 'true' ? 1 : 0;
        $check->save();

        return response(['message' => 'Status has been updated!']);
    }

    // public function manageProducts(Request $request){

    // }

    public function productShow(string $id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        // Fetch the collection and its related active products
        $collection = ProductCollectionMasterModel::with('collectionProducts')->findOrFail($id);
    
        // Get the products directly using the `collectionProducts` relationship
        $products = $collection->collectionProducts;
        $collections = ProductCollectionMasterModel::where('status',1)->get();
        $subCategory = SubCategory::where(['status' => 1])->get();
        $childCategory = ChildCategory::where(['status' => 1])->get();
        $products_max_price = collect($products)->max('price');
        
        return view('frontend.collections.show', compact('collection', 'products','categories','brands','collections','childCategory','subCategory'));
    }
    

}

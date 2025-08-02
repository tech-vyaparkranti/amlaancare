<?php

namespace App\Http\Controllers;

use App\DataTables\ProductCollectionMappingDataTable;
use App\Models\CollectionProductsMappingModel;
use App\Models\Product;
use App\Models\ProductCollectionMasterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCollectionMappingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,ProductCollectionMappingDataTable $dataTable)
    {
        $productCollection = ProductCollectionMasterModel::findOrFail($request->input("product-collection-id"));
        $products = Product::leftJoin(CollectionProductsMappingModel::TABLE_NAME,function($on){
            $on->on(CollectionProductsMappingModel::PRODUCT_ALIAS,Product::ID_ALIAS)->where(CollectionProductsMappingModel::STATUS_ALIAS,1);
        })->where(Product::STATUS_ALIAS,1)->whereNull(CollectionProductsMappingModel::ID_ALIAS)
        ->get([Product::ID_ALIAS,Product::NAME_ALIAS]);
        return $dataTable->render('admin.product.product-collections-manage.index', compact('productCollection','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-collections-manage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "collection_id"=>"required|exists:product_collection_master,id",
            "products"=>"required|array",
            "products.*"=>"exists:products,id"
        ]);
        $allCollectionData = CollectionProductsMappingModel::where(CollectionProductsMappingModel::PRODUCT_COLLECTION_ID,$request->collection_id)->get();
        foreach($request->products as $products){
            $check = $allCollectionData->where(CollectionProductsMappingModel::PRODUCT_ID,$products)->first();
            if($check){
                if($check->{CollectionProductsMappingModel::STATUS}!=1){
                    $check->{CollectionProductsMappingModel::STATUS} = 1;
                    $check->save();
                }
            }else{
                $save = new CollectionProductsMappingModel();
                $save->{CollectionProductsMappingModel::PRODUCT_COLLECTION_ID} = $request->collection_id;
                $save->{CollectionProductsMappingModel::PRODUCT_ID} = $products;
                $save->{CollectionProductsMappingModel::STATUS} = 1;
                $save->save();
            }
        }
        return redirect()->route('admin.product-collections-manage.index', ['product-collection-id' => $request->collection_id]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check  = CollectionProductsMappingModel::findOrFail($id);
        $check->{CollectionProductsMappingModel::STATUS} = 0;
        $check->save();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        
    }
}

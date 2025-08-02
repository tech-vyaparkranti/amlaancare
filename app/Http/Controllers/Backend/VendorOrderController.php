<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorOrderDataTable;
use App\Http\Controllers\Controller;
use App\Libraries\DeliveryPartner\ShipRocket;
use App\Models\Order;
use Illuminate\Http\Request;

class VendorOrderController extends Controller
{
    public function index(VendorOrderDataTable $dataTable)
    {
        return $dataTable->render('vendor.order.index');
    }

    public function show(string $id)
    {
        $order = Order::with(['orderProducts'])->findOrFail($id);
        return view('vendor.order.show', compact('order'));
    }

    public function orderStatus(Request $request, string $id)
{
    $order = Order::findOrFail($id);

    // Update order status in your database
    $order->order_status = $request->status;
    $order->save();

    // Get instance of ShipRocket and place the order
    try {
        $response = (ShipRocket::getInstance())->placeShippingOrder($order);
        
        if ($response['status']) {
            toastr('Status Updated Successfully! Shipping Order Created with ShipRocket.', 'success', 'Success');
        } else {
            toastr('Status Updated Successfully! However, there was an issue with creating the shipping order: ' . $response['message'], 'error', 'Error');
        }
    } catch (\Exception $e) {
        toastr('Error occurred while placing shipping order: ' . $e->getMessage(), 'error', 'Error');
    }

    return redirect()->back();
}

    public function shippingRequest(string $id){
        $order = Order::findOrFail($id);
        return view('vendor.order.addShppingDetails', compact('order'));
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Libraries\DeliveryPartner\ShipRocket;

class ProductTrackController extends Controller
{
    // public function index(Request $request)
    // {
    //     if($request->has('tracker')){
    //         $order = Order::where('invocie_id', $request->tracker)->first();
    
    //         return view('frontend.pages.product-track', compact('order'));
    //     }else {
    //         return view('frontend.pages.product-track');
    //     }
    // }

    public function trackOrder(Request $request)
{
    $order_id = $request->input('order_id');
    $trackingDetails = null;
    $errorMessage = null;
    $awbNumber = null;
    $courierName = null;
    $orderStatus = null;

    if ($order_id) {
        try {
            $shipRocket = new ShipRocket();
            $trackingResponse = $shipRocket->trackOrder($order_id);
            // dd($trackingResponse);

            if ($trackingResponse['status'] === true) {
                $trackingDetails = $trackingResponse['data']['data'][0] ?? null;

                if ($trackingDetails) {
                    $shipmentDetails = $trackingDetails['shipments'][0] ?? null;
                    if ($shipmentDetails) {
                        $awbNumber = $shipmentDetails['awb'] ?? null;
                        $courierName = $shipmentDetails['sr_courier_name'] ?? null;
                    }
                    $orderStatus = $trackingDetails['status'] ?? 'Not Available';
                }
            } else {
                $errorMessage = $trackingResponse['message'] ?? 'Unable to fetch tracking details';
            }
        } catch (\Exception $e) {
            $errorMessage = 'An error occurred while fetching tracking details: ' . $e->getMessage();
        }
    } else {
       
    }

    return view('frontend.pages.product-track', compact('trackingDetails', 'errorMessage', 'awbNumber', 'courierName', 'orderStatus'));
}



}

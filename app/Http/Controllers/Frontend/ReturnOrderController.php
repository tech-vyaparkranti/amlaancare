<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ShipRocketManagement;
use Illuminate\Support\Facades\Storage;
use App\Libraries\DeliveryPartner\ShipRocket;

class ReturnOrderController extends Controller
{
    /**
     * Handle the return order request, including video proof upload.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function submitReturnOrder(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',  
            'shipment_id' => 'required|string',  
            'return_reason' => 'required|string',  
            'pickup_address' => 'required|string',  
            'video_proof' => 'required|file|mimes:mp4,avi,mkv|max:10240', 
        ]);

        
        $videoFilePath = null;
        if ($request->hasFile('video_proof')) {
            
            $videoFilePath = $request->file('video_proof')->store('return_videos', 'public');
        }

        
        $orderReturn = OrderReturn::create([
            'order_id' => $validated['order_id'],
            'return_status' => 'pending',  // Default status is 'pending'
            'return_reason' => $validated['return_reason'],
            'pickup_address' => $validated['pickup_address'],
            'video_proof' => $videoFilePath,  // Store video file path
        ]);

        
        $response = $this->initiateReturnOrder(
            $validated['order_id'],
            $validated['shipment_id'],
            $validated['return_reason'],
            $validated['pickup_address'],
            $videoFilePath  // Send the video file path for the return process
        );

        
        if ($response['status']) {
            return back()->with('success', 'Return request initiated successfully!');
        } else {
            return back()->with('error', 'Failed to initiate return request. Please try again.');
        }
    }

    /**
     * Initiate a return order with ShipRocket API.
     *
     * @param string $order_id
     * @param string $shipment_id
     * @param string $return_reason
     * @param string $pickup_address
     * @param string|null $video_file
     * @return array
     */
    private function initiateReturnOrder($order_id, $shipment_id, $return_reason, $pickup_address, $video_file = null)
    {
        try {
            
            if (empty($order_id) || empty($shipment_id)) {
                return ["status" => false, "message" => "Order ID and Shipment ID are required."];
            }

            
            $payload = [
                'order_id' => $order_id,
                'shipment_id' => $shipment_id,
                'reason' => $return_reason,
                'pickup_address' => $pickup_address,
            ];

            // If a video proof was uploaded, include it in the payload
            if ($video_file) {
                $payload['video_proof'] = $video_file;
            }

            // Send request to ShipRocket API to initiate the return
            $shipRocket = ShipRocket::getInstance();
            $response = $shipRocket->sendRequest("external/orders/return", "post", $payload);

            
            if (isset($response['status']) && $response['status'] === 'success') {
                
                ShipRocketManagement::where('order_id', $order_id)
                    ->update([
                        'return_status' => 'initiated',  
                        'return_reason' => $return_reason,
                        'return_response' => json_encode($response),  
                    ]);

                return ["status" => true, "message" => "Return order successfully initiated.", "data" => $response];
            } else {
                return ["status" => false, "message" => "Failed to initiate return order.", "data" => $response];
            }
        } catch (\Exception $e) {
            // Return error response if an exception occurs
            return ["status" => false, "message" => "Error: " . $e->getMessage()];
        }
    }
}

<?php

namespace App\Libraries\DeliveryPartner;

use App\Models\Order;
use App\Models\ShipRocketManagement;
use App\Models\Vendor;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ShipRocket
{
    protected $url = "https://apiv2.shiprocket.in/v1/";

    private static $instance = null;

    const CHANNEL_ID = "6114668";

    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new ShipRocket();
        }
        return self::$instance;
    }

    public function login($email, $password)
    {
        $response = Http::withBody(json_encode([
            "email" => $email,
            "password" => $password
        ]))->post($this->url . "external/auth/login")->json();


        if (!empty($response["token"])) {
            session(["token" => $response["token"]]);
            return ["status" => true, "message" => "Success", "data" => $response];
        } else {
            return ["status" => false, "message" => "Login failed", "data" => $response];
        }
    }

    public function sendRequest($endPoint, $method, $payload)
    {
        if (!session("token")) {
            $response = $this->login("admin@organicjikaka.com", 'Jikaka$2025');
            if (!$response["status"]) {
                return $response;
            }
        }

        $method = strtolower($method);
        $request = null;

        if ($method == "get") {
            $request = Http::withBody(json_encode($payload))
                ->withHeader("Authorization", "Bearer " . session('token'))
                ->get($this->url . $endPoint)
                ->json();
        } else if ($method == "post") {
            $request = Http::withBody(json_encode($payload))
                ->withHeader("Authorization", "Bearer " . session('token'))
                ->post($this->url . $endPoint)
                ->json();
        }

        return $request;
    }

    public function createOrder(array $order_details)
{
    // Validate input data
    $validator = Validator::make($order_details, [
        "order_id" => "required|string|max:50",
        "order_date" => "required|date",
        "channel_id" => "required|string|max:50",
        "billing_customer_name" => "required|string",
        "billing_last_name" => "nullable|string",
        "billing_address" => "required|string",
        "billing_city" => "required|string|max:30",
        "billing_pincode" => "required|integer",
        "billing_state" => "required|string",
        "billing_country" => "required|string",
        "billing_email" => "required|email",
        "billing_phone" => "required|integer",
        "order_items" => "required|array",
        "order_items.*.name" => "required|string",
        "order_items.*.sku" => "required|string",
        "order_items.*.units" => "required|integer",
        "order_items.*.selling_price" => "required|numeric",
        "payment_method" => "required|in:COD,Prepaid",
        "sub_total" => "required|integer",
        "length" => "nullable|integer",
        "breadth" => "nullable|integer",
        "height" => "nullable|integer",
        "weight" => "nullable|numeric",
        "pickup_location" => "nullable|string",
        "vendor_details" => "required|array",
        "vendor_details.email" => "required|email",
        "vendor_details.phone" => "required|integer",
        "vendor_details.name" => "required|string",
        "vendor_details.address" => "required|string|min:10",
        "vendor_details.address_2" => "nullable|string|min:10",
        "vendor_details.city" => "required|string",
        "vendor_details.state" => "required|string",
        "vendor_details.country" => "required|string",
        "vendor_details.pin_code" => "required|integer",
        "vendor_details.pickup_location" => "required|string|min:10|max:36"
    ]);

    if ($validator->fails()) {
        return ["status" => false, "message" => $validator->getMessageBag()->first()];
    }
    // Ensure that 'vendor_details' is merged with the order details

    // Process order creation and store it in the database
    $order_details_save = $order_details;
    //$order_details_save["vendor_details"] = json_encode($order_details_save["vendor_details"]);
    $order_details_save[ShipRocketManagement::ORDER_ITEMS] = json_encode($order_details_save[ShipRocketManagement::ORDER_ITEMS]);
    unset($order_details_save["transaction_charges"]);
    unset($order_details_save["vendor_details"]);
    // Check if the order already exists
    $check = ShipRocketManagement::where(ShipRocketManagement::ORDER_ID, $order_details["order_id"])->first();
    if ($check) {
        if ($check->{ShipRocketManagement::SHIPMENT_ID}) {
            return ["status" => true, "message" => "Shipping order previously created."];
        }
        ShipRocketManagement::where(ShipRocketManagement::ID, $check->id)->update($order_details_save);
    } else {
        ShipRocketManagement::insert($order_details_save);
    }

    // Call API to create the shipping order
    $response = $this->sendRequest("external/shipments/create/forward-shipment", "post", $order_details);

    if (isset($response['payload']["shipment_id"])) {

        ShipRocketManagement::where(ShipRocketManagement::ORDER_ID, $order_details["order_id"])->update([
            ShipRocketManagement::SHIPMENT_ID => $response['payload']["shipment_id"],
            ShipRocketManagement::SHIPPING_ORDER_ID => $response['payload']["order_shipment_id"],
            ShipRocketManagement::ORDER_STATUS => $response["status"],
            ShipRocketManagement::SHIP_ROCKET_RESPONSE => json_encode($response)
        ]);
        return ["status" => true, "message" => "Shipping order placed."];
    }

    return $response;
}


public function placeShippingOrder(Order $order)
{
    try {

        $vendor = Vendor::where('email', Auth::user()->email)->first();

        if (!$vendor) {
            return ["status" => false, "message" => "Vendor details not found."];
        }

        $address = json_decode($order->order_address);
        $order_items = [];
        $shipping_method = json_decode($order->shipping_method);

        foreach ($order->orderProducts as $product) {
            if ($product->vendor_id === $vendor->id) {
                $hsn_code = $product->hsn_code;
                $order_items[] = [
                    "name" => $product->product_name,
                    "sku" => $product->product->sku ?? "SKU123",
                    "units" => $product->qty,
                    "selling_price" => $product->unit_price,
                    "discount" => "0",
                    "tax" => null,
                    "hsn" => $product->product->hsn_code ?? "123456",
                ];
            }
        }

        $shipping_charges = $shipping_method->cost ?? 0;

//         $pickup_location = "shop no. 195, mohan singh market, INA\n\nDelhi-110023";
// $pickup_location = preg_replace('/\s+/', ' ', $pickup_location);
// $pickup_location = trim($pickup_location);
        $pickup_location = $vendor->pickup_location ?? "Najafgarh";
        $order_details = [
            "order_id" => $order->invocie_id,
            "order_date" => dateTimeString($order->created_at, 'Y-m-d'),
            "pickup_location" => $pickup_location,
            "reseller_name" => $vendor->shop_name ?? "Dummy Vendor",
            "company_name" => env('COMPANY_NAME', 'organic jikaka'),
            "billing_customer_name" => $address->name,
            "billing_last_name" => "Doe",
            "billing_address" => $address->address,
            "billing_address_2" => "Apt 201",
            "billing_city" => $address->city,
            "billing_pincode" => $address->zip,
            "billing_state" => $address->state,
            "billing_country" => $address->country,
            "billing_email" => $address->email,
            "billing_phone" => $address->phone,
            "billing_alternate_phone" => "9876543210",
            "shipping_is_billing" => true,
            "order_items" => $order_items,
            "payment_method" => $order->payment_method,
            "shipping_charges" => $shipping_charges,
            "giftwrap_charges" => null,
            "transaction_charges" => null,
            "total_discount" => null,
            "sub_total" => $order->sub_total,
            "length" => $product->product->length ?? "10",
            "breadth" => $product->product->breadth ?? "10",
            "height" => $product->product->height ?? "10",
            "weight" => $product->product->weight ?? "0.5",
            "channel_id" => ShipRocket::CHANNEL_ID,
            "vendor_details" => [
                "email" => $vendor->email,
                "phone" => $vendor->phone,
                "name" => $vendor->shop_name,
                "address" => $vendor->address,
                "city" => $vendor->city,
                "state" => $vendor->state,
                "country" => $vendor->country,
                "pin_code" => $vendor->pincode,
                "pickup_location" => $pickup_location
            ]
        ];


// dd('ShipRocket Request:', $order_details);

// Call the createOrder function and get the response from ShipRocket
    $response = $this->createOrder($order_details);


        return $response;
    } catch (Exception $exception) {
        return ["status" => false, "message" => $exception->getMessage()];
    }
}




public function trackOrder($order_id)
{
    try {

        if (!$order_id) {
            return ["status" => false, "message" => "Order ID is required."];
        }

        $response = $this->sendRequest("external/orders/track", "get", ["order_id" => $order_id]);

        if (isset($response['status'])) {
            if ($response['status'] === 'success' && isset($response['data'])) {
                return [
                    "status" => true,
                    "message" => "Tracking information fetched successfully.",
                    "data" => $response['data']
                ];
            } else {
                $message = isset($response['message']) ? $response['message'] : "Unable to fetch tracking information.";
                return [
                    "status" => false,
                    "message" => $message,
                    "data" => $response
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Unexpected response format from ShipRocket API.",
                "data" => $response
            ];
        }
    } catch (Exception $e) {
        return [
            "status" => false,
            "message" => "Error while fetching tracking information: " . $e->getMessage()
        ];
    }
}


    public function initiateReturnOrder($order_id, $shipment_id, $return_reason, $pickup_address)
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

            $response = $this->sendRequest("external/orders/return", "post", $payload);

            if (isset($response['status']) && $response['status'] == 'success') {
                // Store return info in the database
                ShipRocketManagement::where('order_id', $order_id)
                    ->update([
                        'return_status' => 'initiated',
                        'return_reason' => $return_reason,
                        'return_response' => json_encode($response)
                    ]);

                return ["status" => true, "message" => "Return order successfully initiated.", "data" => $response];
            } else {
                return ["status" => false, "message" => "Failed to initiate return order.", "data" => $response];
            }
        } catch (Exception $e) {
            return ["status" => false, "message" => "Error: " . $e->getMessage()];
        }
    }
}

<?php


namespace App\Libraries;

use App\Http\Controllers\Frontend\CartController;
use App\Models\CashFreeSetting;
use App\Models\Payment\PurchaseManagement;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CashFreePaymentGateway
{

    private static $instance = null;



    public static function getInstance(): self
    {
        if (self::$instance == null) {
            self::$instance = new CashFreePaymentGateway();
        }
        return self::$instance;
    }

    public function createOrder(Request $request)
    {
        try {
            $cashFree = CashFreeSetting::first();
            $x_api_version = "2023-08-01";
            \Cashfree\Cashfree::$XClientId = $cashFree->{CashFreeSetting::CASH_FREE_CLIENT_ID};
            \Cashfree\Cashfree::$XClientSecret = $cashFree->{CashFreeSetting::CASH_FREE_SECRET_KEY};
            if ($cashFree->{CashFreeSetting::MODE} == "testing") {
                $mode = "sandbox";
                \Cashfree\Cashfree::$XEnvironment = \Cashfree\Cashfree::$SANDBOX;
            } else {
                \Cashfree\Cashfree::$XEnvironment = \Cashfree\Cashfree::$PRODUCTION;
                $mode = "production";
            }
            $total = getFinalPayableAmount();
            $payableAmount = round($total * $cashFree->currency_rate, 2);
            if($payableAmount<=0){
                $message = "Amount should be greater than 0";
                return view("frontend.pages.payment-failure",compact('message'));
            }else{
                $purchase = [
                    PurchaseManagement::AMOUNT => $payableAmount,
                    PurchaseManagement::CURRENCY_CODE => $cashFree->{CashFreeSetting::CURRENCY_NAME},
                    PurchaseManagement::PAYMENT_TYPE => "pre_paid",
                    PurchaseManagement::PAYMENT_GATEWAY => "cash_free",
                    PurchaseManagement::USER_ID => Auth::id(),
                    PurchaseManagement::PRODUCT_IDS => (new CartController())->getCardProductIds(),
                ];
    
                $cashfree = new \Cashfree\Cashfree();
    
                $order_id = generatePurchaseOrder($purchase);
                $customerID = "customer_" . Auth::id();
                $return_url = route("payment-success", ["order-id" => $order_id]);
    
                $create_orders_request = new \Cashfree\Model\CreateOrderRequest();
                $create_orders_request->setOrderId($order_id);
                $create_orders_request->setOrderAmount($payableAmount);
                $create_orders_request->setOrderCurrency('INR');
    
                $customer_details = new \Cashfree\Model\CustomerDetails();
                $customer_details->setCustomerId($customerID);
                $customer_details->setCustomerPhone("9999999999");
                $customer_details->setCustomerEmail("Test@gmail.com");
                $customer_details->setCustomerName("Test Customer");
                $create_orders_request->setCustomerDetails($customer_details);
                $create_orders_request->setOrderMeta(["return_url"=>$return_url]);
                $result = $cashfree->PGCreateOrder($x_api_version, $create_orders_request);
                $pgRequest = json_encode($result);
                $payment_session_id = $result[0]['payment_session_id'];
                updatePurchaseOrder([
                    PurchaseManagement::PAYMENT_GATEWAY_ID=>$payment_session_id,
                    PurchaseManagement::PAYMENT_GATEWAY_REQUEST=>$request->all(),
                    PurchaseManagement::PAYMENT_GATEWAY_REQUEST=>$pgRequest,
                    PurchaseManagement::PAYMENT_STATUS=>PurchaseManagement::PAYMENT_STATUSES[1]
                ],$order_id);
                return view("frontend.pages.payment-gateway.cashFree.start-payments",compact('payment_session_id','mode','return_url'));
            }
            
            
        } catch (Exception $exception) {
            report($exception);
            $message = "Something went wrong.";
            return view("frontend.pages.payment-failure",compact('message'));
        }
    }

    public function confirmPayments($order_id){
        $checkOrder = PurchaseManagement::where(PurchaseManagement::ORDER_ID,$order_id)->first();
        if($checkOrder && $checkOrder->{PurchaseManagement::PAYMENT_STATUS}=="inprocess"){
            $cashFree = CashFreeSetting::first();
            if($cashFree){
                if ($cashFree->{CashFreeSetting::MODE} == "testing") {
                    $url = "https://sandbox.cashfree.com/pg/orders/$order_id";
                } else {
                    $url = "https://api.cashfree.com/pg/orders/$order_id";
                }
               return Http::withHeaders([
                'Accept' => 'application/json',
                'x-api-version'=>"2023-08-01",
                "x-client-id"=>$cashFree->{CashFreeSetting::CASH_FREE_CLIENT_ID},
                "x-client-secret"=>$cashFree->{CashFreeSetting::CASH_FREE_SECRET_KEY}
               ])->get($url)->json();
            }else{
                return ["status"=>false,"message"=>"CashFree Settings not found."];
            }
        }else{
            return ["status"=>false,"message"=>"Check Order it is not having valid order id or order status."];
        }
    }

    public function orderCompleteStatus(PurchaseManagement $order){
        $order->{PurchaseManagement::PAYMENT_STATUS} = PurchaseManagement::PAYMENT_STATUSES[2];
        $order->{PurchaseManagement::PURCHASE_COMPLETION_DATE_TIME} = Carbon::now('+05:30');
        $order->save();
    }

    public function orderFailedStatus(PurchaseManagement $order){
        $order->{PurchaseManagement::PAYMENT_STATUS} = PurchaseManagement::PAYMENT_STATUSES[3];
        $order->{PurchaseManagement::PURCHASE_COMPLETION_DATE_TIME} = Carbon::now('+05:30');
        $order->save();
    }
}

<?php

use App\Models\GeneralSetting;
use App\Models\Payment\PurchaseManagement;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

/** Set Sidebar item active */

function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

/** Check if product have discount */

function checkDiscount($product) {
    $currentDate = date('Y-m-d');

    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }

    return false;
}

/** Calculate discount percent */

function calculateDiscountPercent($originalPrice, $discountPrice) {
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;

    return round($discountPercent);
}


/** Check the product type */

function productType($type)
{
    switch ($type) {
        case 'new_arrival':
            return 'New';
            break;
        case 'featured_product':
            return 'Featured';
            break;
        case 'top_product':
            return 'Top';
            break;

        case 'best_product':
            return 'Best';
            break;
        case 'latest_product':
            return 'Latest';
            break;
        case 'best_seller_product':
            return 'Best Seller';
            break;

        default:
            return '';
            break;
    }
}

/** get total cart amount */

function getCartTotal(){
    $total = 0;
    foreach(\Cart::content() as $product){
        $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

/** get payable total amount */
function getMainCartTotal(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount'){
            $total = $subTotal - $coupon['discount'];
            return $total;
        }elseif($coupon['discount_type'] === 'percent'){
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            $total = $subTotal - $discount;
            return $total;
        }
    }else {
        return getCartTotal();
    }
}

/** get cart discount */
function getCartDiscount(){
    if(Session::has('coupon')){
        $coupon = Session::get('coupon');
        $subTotal = getCartTotal();
        if($coupon['discount_type'] === 'amount'){
            return $coupon['discount'];
        }elseif($coupon['discount_type'] === 'percent'){
            $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
            return $discount;
        }
    }else {
        return 0;
    }
}

/** get selected shipping fee from session */
function getShppingFee(){
    if(Session::has('shipping_method')){
        return Session::get('shipping_method')['cost'];
    }else {
        return 0;
    }
}

/** get payable amount */
function getFinalPayableAmount(){
    return  getMainCartTotal() + getShppingFee();
}

/** lemit text */

function limitText($text, $limit = 20)
{
    return \Str::limit($text, $limit);
}

function getCurrencyIcon()
{
    $icon = GeneralSetting::first();

    return $icon->currency_icon;
}

if(!function_exists('generatePurchaseOrder')){
    function generatePurchaseOrder($purchaseInsert){
         $order_id = generateRandomString(10,2).generateRandomString(10,0);
         $check = PurchaseManagement::where(PurchaseManagement::ORDER_ID,$order_id)->first();
         if(!empty($check)){
            return generatePurchaseOrder($purchaseInsert);
         }
         $purchaseInsert['order_id'] = $order_id;
         $purchaseInsert['payment_status'] = 'inprocess';
         $purchaseInsert['purchase_start_date_time'] = Carbon::now('+05:30');
         $purchaseInsert[PurchaseManagement::CREATED_AT] = Carbon::now('+05:30');
         PurchaseManagement::insert($purchaseInsert);
         return $purchaseInsert['order_id'];
    }
}
if(!function_exists('updatePurchaseOrder')){
    function updatePurchaseOrder($updateData,$order_id){
         $check = PurchaseManagement::where(PurchaseManagement::ORDER_ID,$order_id)->first();
         if(!empty($check)){
            PurchaseManagement::where(PurchaseManagement::ORDER_ID,$order_id)->update($updateData);
            $return = true;
         }else{
            $return = false;
        }
        return $return;
    }
}
if(!function_exists('generateRandomString')){
    function generateRandomString(Int $length,$type=''){
        $nonzero = '123456789';
        if($type==0){
            $characters = '0123456789';    
        }elseif($type==1){
            $characters = 'abcdefghijklmnopqrstuvwxyz';    
        }elseif($type==2){
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }elseif($type==3){
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }elseif($type==4){
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';    
        }elseif($type==5){
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
        }else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $character = $characters[mt_rand(0, $charactersLength - 1)];
            if($i==0 && $character==0){
                $character = $nonzero[mt_rand(0, strlen($nonzero) - 1)];
            }
            $randomString .= $character;
        }
        
        return $randomString;   
    }
}


if (!function_exists('dateTimeString')) {
    function dateTimeString($convert_date = null,$dateFormat = null, $add_period = null,$subtract_period = null,$period_type = null,$timeZone = null){
        if($convert_date){
            $nowDate = Carbon::parse($convert_date);
        }else{
            $nowDate = Carbon::now($timeZone);
        } 
        
         try{
             if(!empty($add_period) && !empty($subtract_period)){
                 return "both add and subtract are given";
             }
             if((is_numeric($add_period) || is_numeric($subtract_period)) && !empty($period_type) && 
             in_array($period_type,["year","quarter","month","week","day","hour","minute","second"])){
                 if(!empty($add_period)){
                     switch($period_type){
                         case "year":
                             $nowDate->addYears($add_period);
                             break;
                         case "quarter":
                             $nowDate->addQuarters($add_period);
                             break;
                         case "month":
                             $nowDate->addMonths($add_period);
                             break;
                         case "week":
                             $nowDate->addWeeks($add_period);
                             break;
                         case "day":
                             $nowDate->addDays($add_period);
                             break;
                         case "week":
                             $nowDate->addHours($add_period);
                             break;
                         case "day":
                             $nowDate->addMinutes($add_period);
                             break;                        
                         case "second":
                             $nowDate->addSeconds($add_period);
                             break;
                         default:
                         return "Unknown Period";
                     }
                 }
                 if(!empty($add_period)){
                     switch($period_type){
                         case "year":
                             $nowDate->subYears($add_period);
                             break;
                         case "quarter":
                             $nowDate->subQuarters($add_period);
                             break;
                         case "month":
                             $nowDate->subMonths($add_period);
                             break;
                         case "week":
                             $nowDate->subWeeks($add_period);
                             break;
                         case "day":
                             $nowDate->subDays($add_period);
                             break;
                         case "week":
                             $nowDate->subHours($add_period);
                             break;
                         case "day":
                             $nowDate->subMinutes($add_period);
                             break;                        
                         case "second":
                             $nowDate->subSeconds($add_period);
                             break;
                         default:
                         return "Unknown Period";
                     }
                 }
                 
             }
              
             if(!empty($dateFormat)){
                $nowDate = $nowDate->format($dateFormat);
             }
             return $nowDate;
         }catch(Exception $exception){
             return $exception->getMessage();
         }
    }
 
 }

 if(!function_exists('getException')){
    function getException(Exception $exception){
        return [
            "getMessage"=>$exception->getMessage(),
            "getFile"=>$exception->getFile(),
            "getCode"=>$exception->getCode(),
            "getLine"=>$exception->getLine(),
            "getTraceAsString"=>$exception->getTraceAsString()
        ];
    }
 }
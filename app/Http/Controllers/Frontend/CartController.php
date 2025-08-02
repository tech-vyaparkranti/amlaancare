<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Adverisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductColours;
use App\Models\ProductFonts;
use App\Models\ProductVariantItem;
use App\Models\ShoppingCart;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CartController extends Controller
{

    use ImageUploadTrait;
    /** Show cart page  */
    public function cartDetails()
    {
        $cartItems = Cart::content();

        foreach($cartItems as $cart)
        {
            $product = Product::where('id',$cart->id)->first();
            $cart->minQty = $product->category->min_quantity;
        }

        if(count($cartItems) === 0){
            Session::forget('coupon');
            toastr('Please add some products in your cart for view the cart page', 'warning', 'Cart is empty!');
            return redirect()->route('home');
        }
        $cartpage_banner_section = Adverisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('frontend.pages.cart-detail', compact('cartItems', 'cartpage_banner_section'));
    }

    /** Add item to cart */
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);
        // dd($product);

        $minQty = $product->category->min_quantity;
        $request->qty *= $minQty;

        $shopping_cart = [];
       
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }
 
        $shopping_cart[ShoppingCart::QANTITY] = $product->qty;

        $variants = [];
        $variantTotalAmount = 0;
        $check =ShoppingCart::where([
            [ShoppingCart::PRODUCT_ID,$product->id],
            [ShoppingCart::STATUS,1],
            [ShoppingCart::USER_ID,Auth::user()->id??null],
            [ShoppingCart::TEMP_SESSION_ID,session("session_unique_id",null)]
            ])->first();
        $final_product = $this->getFinalCartData($request,$product);
        if($final_product["status"]){
            if($request->has('variants_items')){
                foreach($request->variants_items as $item_id){
                    $variantItem = ProductVariantItem::find($item_id);
                    $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                    $variants[$variantItem->productVariant->name]['price'] = $variantItem->price * $request->qty;
                    $variantTotalAmount += $variantItem->price;
                }
            }
           
            $productPrice = $final_product["data"]["shopping_cart"]["price"];
            $shopping_cart = $final_product["data"]["shopping_cart"];
            
    
            $cartData = [];
            $cartData['id'] = $product->id;
            $cartData['name'] = $product->name;
            $cartData['qty'] = $request->qty;
            $cartData['price'] = $productPrice;
            $cartData['weight'] = 10;
            $cartData['options']['variants'] = $variants;
            $cartData['options']['variants_total'] = $variantTotalAmount;
            $cartData['options']['image'] = $product->thumb_image;
            $cartData['options']['slug'] = $product->slug;
            $shopping_cart[ShoppingCart::VARIANT_OPTIONS] = json_encode($cartData["options"]);
            if($check){
                ShoppingCart::where(ShoppingCart::ID,$check->id)->update($shopping_cart);
            }else{
                ShoppingCart::insert($shopping_cart);
            }
            Cart::add($cartData);
    
            return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
        }else{
            $return = response($final_product);
        }
        return $return;
    }

    /** Update product quantity */
    public function updateProductQty(Request $request)
    {
        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        $minQty = $product->category->min_quantity;

        if($request->quantity < $minQty)
        {
            return response(['status' => 'error', 'message' => "You can't select a quantity less than the minimum required: $minQty."]);
        }

        // check product quantity
        if($product->qty === 0){
            return response(['status' => 'error', 'message' => 'Product stock out']);
        }elseif($product->qty < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity not available in our stock']);
        }
        ShoppingCart::where([
            
            ShoppingCart::USER_ID=>Auth::user()->id??null,
            ShoppingCart::TEMP_SESSION_ID=>$this->userSessionId()??null,
            ShoppingCart::PRODUCT_ID=>$productId
        ])->update([ShoppingCart::QANTITY=>$request->quantity]);
        $cartItem = Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);

        $cart_qty = $cartItem->qty;
        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_total' => $productTotal ,'minQty'=>$minQty ,'cart_qty' => $cart_qty]);
    }

    /** get product total */
    public function getProductTotal($rowId)
    {
       $product = Cart::get($rowId);
       $total = ($product->price + $product->options->variants_total) * $product->qty;
       return $total;
    }

    /** get cart total amount */
    public function cartTotal()
    {
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    /** clear all cart products */
    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
    }

    /** Remove product form cart */
    public function removeProduct($rowId)
    {
        $productId = Cart::get($rowId)->id;
        Cart::remove($rowId);
        ShoppingCart::where([
            
            ShoppingCart::USER_ID=>Auth::user()->id??null,
            ShoppingCart::TEMP_SESSION_ID=>$this->userSessionId()??null,
            ShoppingCart::PRODUCT_ID=>$productId
        ])->update([ShoppingCart::STATUS=>0]);
        toastr('Product removed succesfully!', 'success', 'Success');
        return redirect()->back();
    }

    /** Get cart count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Get all cart products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /** Romve product form sidebar cart */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }

    /** Apply coupon */
    public function applyCoupon(Request $request)
    {
        if($request->coupon_code === null){
            return response(['status' => 'error', 'message' => 'Coupon filed is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if($coupon === null){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif($coupon->start_date > date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif($coupon->end_date < date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon is expired']);
        }elseif($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'you can not apply this coupon']);
        }

        if($coupon->discount_type === 'amount'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        }elseif($coupon->discount_type === 'percent'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    /** Calculate coupon discount */
    public function couponCalculation()
    {
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if($coupon['discount_type'] === 'amount'){
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            }elseif($coupon['discount_type'] === 'percent'){
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        }else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }

    public function getFinalCartData(Request $request,$product){
        try{
            $shopping_cart = [
                ShoppingCart::PRODUCT_ID=>$request->product_id,
                ShoppingCart::QANTITY=>$request->qty,
                ShoppingCart::PRICE=>"",
                ShoppingCart::VARIANT_OPTIONS=>"",
                ShoppingCart::PRODUCT_INFO=>"",
                ShoppingCart::SPECIAL_INSTRUCTIONS=>$request->special_instructions,
                ShoppingCart::STATUS=>1,
                ShoppingCart::USER_ID=>Auth::user()->id??null,
                ShoppingCart::TEMP_SESSION_ID=>$this->userSessionId(),

            ];
            $product_info = [
                "outside_name"=>$request->outside_name,
                "product_font_id"=>$request->product_font,
                "colour_name_id"=>$request->colour_name,
                "zip_colour_name_id"=>$request->zip_colour_name,
                "inside_text_value"=>$request->inside_text_value,
                "inside_date_value"=>$request->inside_date_value,
                "inside_hand_writing_file"=>"",
                "design_file"=>"",
                "custom_design_details_text"=>$request->custom_design_details_text,
                "gift_note_text"=>$request->gift_note_text,
                "rush_service_date"=>$request->rush_service_date,
                "special_instructions"=>$request->special_instructions,
            ];
            if(checkDiscount($product)){
                $price = $product->offer_price;
            }else {
                $price = $product->price;
            }
            if($request->inside_text_option){
                $price += $product->{Product::INSIDE_TEXT_PRICE};
            }
            if($request->custom_design_option){
                $price += $product->{Product::CUSTOM_DESIGN_OPTION_PRICE};
            }

            if($request->gift_wrap_option=="yes"){
                $price += $product->{Product::GIFT_WRAP_OPTION_PRICE};
            }
            if($request->rush_service=="yes"){
                $price += $product->{Product::RUSH_SERVICE_PRICE};
            }
            $validator = Validator::make($request->all(),
            [
                'outside_name'=>$product->{Product::TAKE_NAME}=="yes"?"string|max:20":"nullable",
                "product_font"=>["nullable",Rule::exists("product_font","font_id")
                ->where(function (Builder $query) use($product) {
                    return $query->where(ProductFonts::PRODUCT_ID,$product->id)
                    ->where(ProductFonts::STATUS,1);
                })
               
            ],
            "colour_name"=>["nullable",Rule::exists("product_colours","colour_master_id")
            ->where(function (Builder $query) use($product) {
                return $query->where(ProductColours::PRODUCT_ID,$product->id)
                ->where(ProductColours::STATUS,1);
            }),
            ],
            "zip_colour_name"=>["nullable",Rule::exists("product_colours","colour_master_id")
                                    ->where(function (Builder $query) use($product) {
                                        return $query->where(ProductColours::PRODUCT_ID,$product->id)
                                        ->where(ProductColours::STATUS,1);
                                    }),
                ],
            "inside_text_value"=>"nullable|max:20|string|required_if:inside_text_option,Text",
            "inside_date_value"=>"nullable|max:20|string|required_if:inside_text_option,Date",
            "inside_hand_writing_value"=>"nullable|file|image|max:2048|required_if:inside_text_option,Handwriting",
            "design_file"=>"nullable|file|image|max:2048|required_if:custom_design_option,yes",
            "custom_design_details_text"=>"nullable|string|required_if:custom_design_option,yes",
            "gift_note_text"=>"nullable|required_if:gift_wrap_option,yes|string",
            "rush_service_date"=>"date|nullable|required_if:rush_service,yes|after_or_equal:today",
            "special_instructions"=>"nullable|string"
        ]);
        if($validator->fails()){
            $return = ["status"=>false,"message"=>$validator->getMessageBag()->first(),"data"=>[]];
        }else{
            $imagePath= "";
            if($request->design_file){
                /** Handle the image upload */
                $imagePath = $this->updateImage($request, 'design_file', 'uploads/cart_images');
            }
            $inside_hand_writing_image_path = "";
            if($request->inside_hand_writing_value){
                /** Handle the image upload */
                $inside_hand_writing_image_path = $this->updateImage($request, 'inside_hand_writing_value', 'uploads/cart_images/inside_hand_writing');
            }
            $product_info["design_file"] = $imagePath;
            $product_info["inside_hand_writing_file"] = $inside_hand_writing_image_path;
            $product->price = $price;
            $shopping_cart["price"] = $price;
            $shopping_cart[ShoppingCart::PRODUCT_INFO] = json_encode($product_info);
            $return = ["status"=>true,"message"=>"Success","data"=>[
                "shopping_cart"=>$shopping_cart,
                "product_info"=>$product_info
            ]];
        }
        return $return;
        }catch(Exception $exception){
            
        }
    }

    public function userSessionId(){
        $return = null;
        if(empty(Auth::user()->id)){
            if(session()->has("session_unique_id")){
                $return = session("session_unique_id");
            }else{
                $random = Str::random(20);
                $check = ShoppingCart::where(ShoppingCart::TEMP_SESSION_ID,$random)->first();
                if($check){
                    $return = $this->userSessionId();
                }else{
                    session(["session_unique_id",$random]);
                    $return = $random;
                }
            }
        }
        return $return;
    }

    public function getCardProductIds():string{
        $product_ids = [];
        foreach(Cart::content() as $product){
            $product_ids = $product->id;
        }
        return json_encode($product_ids);
    }

}

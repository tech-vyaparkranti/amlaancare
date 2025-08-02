<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\VendorRegistrationController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserMessageController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Backend\ProductCollectionController;
use App\Http\Controllers\Frontend\UserVendorReqeustController;
use App\Http\Controllers\Backend\ProductController;
use App\Libraries\DeliveryPartner\ShipRocket;
use App\Http\Controllers\Frontend\ReturnOrderController;
use App\Http\Controllers\Frontend\UserPendingOrderController;
use App\Http\Controllers\Frontend\UserCompleteOrderController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ManageHomeController;
use App\Http\Controllers\SupplyChainController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\Backend\BrandController;

use App\Http\Controllers\ExitTrackerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('shop');
Route::get('/shop', [HomeController::class, 'index1'])->name('home');
Route::get('/shop/collection/{brand_id?}', [HomeController::class, 'index'])->name('shop.collection');

Route::post('/submit-lead', [LeadController::class, 'store'])->name('submit-lead');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

/** Product route */
Route::get('products/{category_slug?}/{subcategory_slug?}/{childcategory_slug?}/{brand_slug?}', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontendProductController::class, 'chageListView'])->name('change-product-list-view');
Route::post('/store-download', [FrontendProductController::class, 'storeDownload'])->name('storeDownload');

/** Cart routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

/** Newsletter routes */

Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequset'])->name('newsletter-request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVarify'])->name('newsletter-verify');

/** vendor page routes */
Route::get('vendor', [HomeController::class, 'vendorPage'])->name('vendor.index');
Route::get('vendor-product/{id}', [HomeController::class, 'vendorProductsPage'])->name('vendor.products');

/** about page route */
Route::get('about', [PageController::class, 'about'])->name('about');
/** team page route */
Route::get('team', [PageController::class, 'team'])->name('team');
/** fonuder page route */
Route::get('founder', [PageController::class, 'founder'])->name('founder');
/** terms and conditions page route */
Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions');
Route::get('shipping-policy', [PageController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('cancellation-policy', [PageController::class, 'cancellationPolicy'])->name('cancellation-policy');
/** contact route */
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');
Route::get('vendor-registration', [PageController::class, 'vendorRegistration'])->name('vendorRegistration');
Route::post('/vendor-registration/store', [VendorRegistrationController::class, 'store'])->name('vendor-registration.store');
Route::get('bulk-order', [PageController::class, 'bulkOrder'])->name('bulkOrder');

/** Product track route */
Route::get('traking-order', [ProductTrackController::class, 'trackOrder'])->name('product-traking.index');


/** blog routes */
Route::get('blog-details/{slug}', [BlogController::class, 'blogDetails'])->name('blog-details');
Route::get('blog', [BlogController::class, 'blog'])->name('blog');

/** Product routes */
Route::get('show-product-modal/{id}', [HomeController::class, 'ShowProductModal'])->name('show-product-modal');
/** add product in wishlist */
Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');









Route::group(['middleware' =>['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile'); // user.profile
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update'); // user.profile.update
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    /** Message Route */
    Route::get('messages', [UserMessageController::class, 'index'])->name('messages.index');
    Route::post('send-message', [UserMessageController::class, 'sendMessage'])->name('send-message');
    Route::get('get-messages', [UserMessageController::class, 'getMessages'])->name('get-messages');

    /** User Address Route */
    Route::resource('address', UserAddressController::class);
    /** Order Routes */
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    /** Wishlist routes */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destory'])->name('wishlist.destory');

    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');

    /** Vendor request route */
    Route::get('vendor-request', [UserVendorReqeustController::class, 'index'])->name('vendor-request.index');
    Route::post('vendor-request', [UserVendorReqeustController::class, 'create'])->name('vendor-request.create');

    /** product review routes */
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');

    /** blog comment routes */
    Route::post('blog-comment', [BlogController::class, 'comment'])->name('blog-comment');

    /** Checkout routes */
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /** Paypal routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    /** Stripe routes */
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

    /** Razorpay routes */
    Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorPay'])->name('razorpay.payment');

    /** COD routes */
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');

    /** Cash Free routes */
    Route::get('cash-free/payment', [PaymentController::class, 'payWithCashFreePay'])->name('cashfree.startPayment');

});
Route::any("payment-successful",[PaymentController::class,"cashFreePaymentVerify"])->name("payment-success");
Route::any("payment-failure",[PaymentController::class,"paymentFailure"])->name("payment-failure");
Route::get('/collections/{id}/{collection_name?}', [ProductCollectionController::class, 'productShow'])->name('frontend.collections.show');
Route::get('/dynamicproducts', [ProductController::class, 'index']);
Route::post('/contact/store', [ContactFormController::class, 'store'])->name('contact.store');
Route::post('/contact/store', [ContactFormController::class, 'store'])->name('contact.store');


Route::get("test",function(){
    $object = (new ShipRocket())->getInstance();
    $object->login("info.venuses@gmail.com",'Password@2024');
});

Route::get('/order/track', [ProductTrackController::class, 'trackOrder'])->name('order.track');

Route::get('/return-order', [ReturnOrderController::class, 'submitReturnOrder'])->name('returnOrder.submit');

Route::get('user/orders/cancel/{id}', [UserOrderController::class, 'cancel'])->name('user.orders.cancel');
Route::get('user/orders/return/{id}', [UserOrderController::class, 'return'])->name('user.orders.return');

Route::get('/user/pending/orders', [UserPendingOrderController::class, 'index'])->name('user.pending.orders.index');
Route::get('/user/pending/orders/{id}', [UserPendingOrderController::class, 'show'])->name('user.pending.orders.show');
Route::get('/user/pending/orders/cancel/{id}', [UserPendingOrderController::class, 'cancel'])->name('user.pending.orders.cancel');
Route::get('/user/pending/orders/return/{id}', [UserPendingOrderController::class, 'return'])->name('user.pending.orders.return');

Route::get('/user/complete/orders', [UserCompleteOrderController::class, 'index'])->name('user.complete.orders.index');
Route::get('/user/complete/orders/{id}', [UserCompleteOrderController::class, 'show'])->name('user.complete.orders.show');
Route::get('/user/complete/orders/return/{id}', [UserCompleteOrderController::class, 'return'])->name('user.complete.orders.return');


Route::get('/manage-home', [ManageHomeController::class, 'manageHome'])->name('manageHome');
Route::post('/home-page-details', [ManageHomeController::class, 'store'])->name('home.page.store');
Route::post('/home-page/{id}/toggle-status', [ManageHomeController::class, 'toggleStatus'])->name('home.page.toggleStatus');
// Route::get('home/details/edit/{id}', [ManageHomeController::class, 'edit'])->name('home.page.edit');
// Route::get('home/details/edit/{homePageDetail}', [ManageHomeController::class, 'edit'])->name('home.page.edit');

// Route::post('/home-page/{id}/update', [ManageHomeController::class, 'update'])->name('home.page.update');
Route::get('admin/home-page/{id}/edit', [ManageHomeController::class, 'edit'])->name('home.page.edit');
Route::put('admin/home-page/{id}', [ManageHomeController::class, 'update'])->name('home.page.update');

Route::get('/manage-supply-chain', [SupplyChainController::class, 'manageSupplyChain'])->name('manageSupplyChain');

// Store New Supply Chain Content
Route::post('admin/supply-chain/store', [SupplyChainController::class, 'store'])->name('supplyChain.store');

// Display Edit Form for Supply Chain Content
Route::get('admin/supply-chain/edit/{id}', [SupplyChainController::class, 'edit'])->name('supplyChain.edit');

// Update Existing Supply Chain Content
Route::put('admin/supply-chain/update/{id}', [SupplyChainController::class, 'update'])->name('supplyChain.update');

// Toggle the Status of a Supply Chain Content (Enable/Disable)
Route::post('admin/supply-chain/status/{id}', [SupplyChainController::class, 'toggleStatus'])->name('supplyChain.toggleStatus');

// Delete a Supply Chain Content
Route::delete('admin/supply-chain/destroy/{id}', [SupplyChainController::class, 'destroy'])->name('supplyChain.destroy');


// Custom route for managing certifications (display all certifications)
Route::get('/manage-certifications', [CertificationController::class, 'manageCertifications'])->name('manageCertifications');

// Define the routes for store, update, and other actions
Route::post('/admin/certifications', [CertificationController::class, 'store'])->name('certifications.store');
Route::get('/admin/certifications/{id}/edit', [CertificationController::class, 'edit'])->name('certifications.edit');
Route::patch('/admin/certifications/{id}', [CertificationController::class, 'update'])->name('certifications.update');
Route::patch('admin/certifications/{id}/toggleStatus', [CertificationController::class, 'toggleStatus'])->name('certifications.toggleStatus');

Route::resource('faq', FaqController::class);
// Route::get('/faqs', [FaqController::class, 'manageFAQ'])->name('faq.index');
Route::post('/faqs/{id}/disable', [FaqController::class, 'disable'])->name('faq.disable');
Route::post('/faqs/{id}/enable', [FaqController::class, 'enable'])->name('faq.enable');
Route::post('/faq/{id}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faq.toggleStatus');

Route::get('Spice-Qualty-Testing-Report', [BatchController::class, 'showBatchTrackingForm'])->name('batchTrackingForm');

// Handle Batch Tracking Request (when form is submitted)
Route::get('track-batch', [BatchController::class, 'trackBatch'])->name('trackBatch');

Route::get('/manage-batch', [BatchController::class, 'manageBatch'])->name('manageBatch');
Route::resource('batch', BatchController::class);  // This will handle all CRUD routes

Route::get('/admin/batch/{id}/edit', [BatchController::class, 'edit'])->name('batch.edit');

// Update existing batch details
Route::put('/admin/batch/{id}', [BatchController::class, 'update'])->name('batch.update');

// Delete batch details
Route::delete('/admin/batch/{id}', [BatchController::class, 'destroy'])->name('batch.destroy');

// Toggle batch status (Enable/Disable)
Route::post('/admin/batch/{id}/toggle-status', [BatchController::class, 'toggleStatus'])->name('batch.toggleStatus');

Route::get('/show-brand/{id}',[BrandController::class,'brandProduct'])->name('brand.product');

Route::post('/track-exit', [ExitTrackerController::class, 'trackExit'])->name('track.exit');

Route::get('/refresh-csrf', function () {
    return response()->json(['token' => csrf_token()]);
})->name('refresh-csrf');


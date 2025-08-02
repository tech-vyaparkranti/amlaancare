<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\Contact;
use App\Models\About;
use App\Models\ShippingRule;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\shippingPolicy;
use App\Models\TermsAndCondition;
use App\Models\CancellationPolicy;
use App\Models\EmailConfiguration;
use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Exception;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first();
        return view('frontend.pages.about', compact('about'));
    }
    public function team()
    {
        // $about = About::first();
        return view('frontend.pages.team');
    }
    public function shippingPolicy()
    {
        $shipping = shippingPolicy::first();
        // dd($shipping);
        return view('frontend.pages.shippingPolicy',compact('shipping'));
    }
    public function privacyPolicy()
    {
        $privacy = PrivacyPolicy::first();
        return view('frontend.pages.privacyPolicy',compact('privacy'));
    }
    public function cancellationPolicy()
    {
        $cancel = CancellationPolicy::first();
        return view('frontend.pages.cancellationPolicy',compact('cancel'));
    }
    public function founder()
    {
        // $about = About::first();
        return view('frontend.pages.founder');
    }

    public function termsAndCondition()
    {
        $terms = TermsAndCondition::first();
        return view('frontend.pages.terms-and-condition', compact('terms'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function vendorRegistration()
    {
        return view('frontend.pages.vendor-registration');
    }
    public function bulkOrder()
    {
        return view('frontend.pages.bulkOrder');
    }

    public function handleContactForm(Request $request)
    {
        
        try{
            $request->validate([
                'name' => ['required', 'max:200'],
                'email' => ['required', 'email'],
                'subject' => ['required', 'max:200'],
                'message' => ['required', 'max:1000']
            ]);
    
            $setting = EmailConfiguration::first();
            $check = ContactForm::where(
                [
                    ['email',$request->email],
                    ['name',$request->name],
                    ['subject',$request->subject]
                ]
            )->first();
            if(empty($check)){
                ContactForm::insert($request->all(['name', 'email', 'subject', 'message']));
            }
            $message = "Message saved and mail sent successfully!";
            $revert = "Thank you for contacting we have received your email and will revert on this shortly. Your query is :: ". $request->message;
            Mail::to($request->email)->send(new Contact($request->subject, $revert, $request->email));
            if($setting->email){
                Mail::to($setting->email)->send(new Contact($request->subject, $request->message, $request->email));
            }
            
        }catch(Exception $exception){
            $message = "Message saved and mail not sent successfully!";
            report($exception);
        }
        return response(['status' => 'success', 'message' => $message]);

    }
   
}

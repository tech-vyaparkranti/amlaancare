<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    // public function store(Request $request){
    //     $request->validate([
    //         'name'=>'required|max:255',
    //         'email'=>'required|email',
    //         'subject'=>'required|max:255',
    //         'message'=>'required',
    //     ]);

    //     ContactForm::create([
    //         'name'=>$request->name,
    //         'email'=>$request->email,
    //         'subject'=>$request->subject,
    //         'message'=>$request->message,
    //             ]);
    //         return response()->json(['message'=>'Your message has been sent successfully']);
    // }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        // Store the data into the database
        $contact = new ContactForm();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return response()->json(['message' => 'Your message has been sent successfully']);
    }
}

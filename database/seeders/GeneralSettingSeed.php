<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = GeneralSetting::first();

        if(empty($check)){
            $object = new  GeneralSetting();
            //				2023-04-04 05:49:00
           $object->site_name = "Ecommerce";
           $object->layout = "LTR";
           $object->contact_email = "info@vyaparkranti.in";
           $object->contact_phone = "+91 995 822 4825";
           $object->contact_address = "India";
           $object->map = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.5680203459287!2d76.98404747555219!3d28.61273337567553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0fdda4eabfb1%3A0x1b29e6f8e8722395!2sVyapar%20Kranti!5e0!3m2!1sen!2sin!4v1702525909680!5m2!1sen!2sin";
           $object->currency_name = "INR";
           $object->currency_icon = "₹";
           $object->time_zone = "Asia/Kolkata";
           $object->save();
        }
        
    }
}
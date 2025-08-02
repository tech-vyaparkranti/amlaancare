<?php

namespace Database\Seeders;

use App\Models\FooterInfo;
use App\Models\FooterMenu;
use App\Models\FooterTitle;
use App\Models\FooterSocial;
use App\Models\FooterGridTwo;
use Illuminate\Support\Carbon;
use App\Models\FooterGridThree;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FooterInfoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check =FooterInfo::first();
        if(empty($check)){
            $object = new FooterInfo();
            $object->logo = "uploads/media_662bd69d66085.png";
            $object->phone = "+91 995 822 4825";
            $object->email = "Info@vyaparkranti.in";
            $object->address = "India";
            $object->copyright = "Copyright © 2024 Vyaparkranti All Rights Reserved. Design & Developed By www.vyaparkranti.com";

            $object->save();
        }

        $check =FooterSocial::first();
        if(empty($check)){
            FooterSocial::insert([
                [
                    "icon"=>"fab fa-twitter",
                    "name"=>"X",
                    "url"=>"https://twitter.com/vyaparkranti",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "icon"=>"fab fa-facebook-f",
                    "name"=>"Facebook",
                    "url"=>"https://www.facebook.com/vyaparkranti/",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "icon"=>"fab fa-linkedin-in",
                    "name"=>"linkedin",
                    "url"=>"https://www.linkedin.com/in/vyapar-kranti-0a0b64271/",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "icon"=>"fab fa-instagram",
                    "name"=>"instagram",
                    "url"=>"https://www.instagram.com/vyaparkranti/",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ]

            ]);
        }


        $check =FooterGridTwo::first();
        if(empty($check)){ 
            FooterGridTwo::insert([
                [
                    "name"=>"About",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Terms andconditions",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Contact",
                    "url"=>"https://www.vyaparkranti.in/contact-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                

            ]);
        }

        $check =FooterMenu::first();
        if(empty($check)){ 
            FooterMenu::insert([
                [
                    "name"=>"About",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Terms andconditions",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Contact",
                    "url"=>"https://www.vyaparkranti.in/contact-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                

            ]);
        }
        $check =FooterGridTwo::first();
        if(empty($check)){ 
            FooterGridThree::insert([
                [
                    "name"=>"About",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Terms andconditions",
                    "url"=>"https://www.vyaparkranti.in/about-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                [
                    "name"=>"Contact",
                    "url"=>"https://www.vyaparkranti.in/contact-us",
                    "status"=>"1",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ],
                

            ]);
        }


        $check =FooterTitle::first();
        if(empty($check)){ 
            FooterTitle::insert([
                [
                    "footer_grid_two_title"=>"More Links",
                    "footer_menu_title"=>"Venuses",
                    "footer_grid_three_title"=>"Help Links",
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(), 
                ]
            ]);
        }
    }
}
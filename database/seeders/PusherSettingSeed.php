<?php

namespace Database\Seeders;

use App\Models\PusherSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PusherSettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = PusherSetting::first();
        if(empty($check)){
            $object = new PusherSetting(); 
            $object->pusher_app_id = "1715951";
            $object->pusher_key = "7e683f71cce89b04bf45";
            $object->pusher_secret = "ea6436c0db4edcd98c28";
            $object->pusher_cluster = "mt1";
    
            $object->save();
        }
       

    }
}
<?php

namespace Database\Seeders;

use App\Models\LogoSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoSettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = LogoSetting::first();
        if(empty($check)){
            $object =  new LogoSetting();
            $object->logo = "uploads/default_logo.png";
            $object->favicon = "uploads/default_logo.png";
            $object->save();
        }
        
    }
}
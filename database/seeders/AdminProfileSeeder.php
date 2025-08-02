<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $check = Vendor::first();
        if(empty($check)){
            $user = User::where('role', 'admin')->get();
            if(count($user)>0){
                foreach($user as $u){
                    if(empty($u->vendor->id)){
                        $vendor = new Vendor();
                        $vendor->banner = 'uploads/1343.jpg';
                        $vendor->shop_name = 'Admin Shop';
                        $vendor->phone = '12321312';
                        $vendor->email = $u->email;
                        $vendor->address = 'Usa';
                        $vendor->description = 'shop description';
                        $vendor->user_id = $u->id;
                        $vendor->save();
                    }
                }
            }
        }
    }
}
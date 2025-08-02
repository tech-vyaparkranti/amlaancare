<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')
            ->whereNull('city') 
            ->update([
                'city' => 'New delhi',
                'state' => 'delhi',
                'pincode' => '110043',
                'country' => 'india',
                'pickup_location' => 'Warehouse A',
            ]);
    }
}

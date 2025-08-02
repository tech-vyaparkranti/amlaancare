<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorRollbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // If you want to delete data that was added by your previous seeder:
        DB::table('vendors')
            ->whereNull('city') 
            ->update([
                'city' => null,
                'state' => null,
                'pincode' => null,
                'country' => null,
                'pickup_location' => null,
            ]);
    }
}

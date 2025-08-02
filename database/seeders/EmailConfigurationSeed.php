<?php

namespace Database\Seeders;

use App\Models\EmailConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailConfigurationSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 		
        $check = EmailConfiguration::first();
        if(empty($check)){
            $object = new EmailConfiguration();
            $object->email = "support@vyaparkranti.com";
            $object->host = "sandbox.smtp.mailtrap.io";
            $object->username = "06315509852650";
            $object->password = "49b4e9f784e827";
            $object->port = "2525";
            $object->encryption = "tls";
            
    
            $object->save();
        }
        
    }
}
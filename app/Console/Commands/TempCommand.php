<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TempCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tempCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        if(Storage::disk("local")->exists("TempCommand.txt")){
            echo "Already running";
            Log::info("Already running");
        }else{
            Storage::disk("local")->put("TempCommand.txt","testing");
            echo "Running";
            Log::info("Running");
            //sleep("100");
            Http::get("https://preprod.dreamfolks.in/cron/txn-report");
            Storage::disk("local")->delete("TempCommand.txt");
            
            Log::info("Completed");
            echo "Completed";
        }
    }
}

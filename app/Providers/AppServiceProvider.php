<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use App\Models\LogoSetting;
use App\Models\PusherSetting;
use Exception;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $generalSetting = $this->generalSettings();
        $logoSetting = $this->logoSetting();
        $mailSetting = $this->emailConfiguration();
        $pusherSetting = $this->pusherSetting();
        /** set time zone */
        Config::set('app.timezone', $generalSetting->time_zone??"UTC");

        /** Set Mail Config */
        Config::set('mail.mailers.smtp.host', $mailSetting->host??"");
        Config::set('mail.mailers.smtp.port', $mailSetting->port??"");
        Config::set('mail.mailers.smtp.encryption', $mailSetting->encryption??"tls");
        Config::set('mail.mailers.smtp.username', $mailSetting->username??"");
        Config::set('mail.mailers.smtp.password', $mailSetting->password??"");

        /** Set Broadcasting Config */
        Config::set('broadcasting.connections.pusher.key', $pusherSetting->pusher_key??"");
        Config::set('broadcasting.connections.pusher.secret', $pusherSetting->pusher_secret??"");
        Config::set('broadcasting.connections.pusher.app_id', $pusherSetting->pusher_app_id??"");
        Config::set('broadcasting.connections.pusher.options.host', "api-".($pusherSetting->pusher_cluster??"").".pusher.com");



        /** Share variable at all view */
        View::composer('*', function($view) use ($generalSetting, $logoSetting, $pusherSetting){
            $view->with(['settings' => $generalSetting, 'logoSetting' => $logoSetting, 'pusherSetting' => $pusherSetting]);
        });

    }

    public function generalSettings(){
        try{
            return GeneralSetting::first();
        }catch(Exception $exception){

        }
    }

    public function logoSetting(){
        try{
            return LogoSetting::first();
        }catch(Exception $exception){

        }
    }

    public function emailConfiguration(){
        try{
            return EmailConfiguration::first();
        }catch(Exception $exception){

        }
    }

    public function pusherSetting(){
        try{
            return PusherSetting::first();
        }catch(Exception $exception){

        }
    }
}

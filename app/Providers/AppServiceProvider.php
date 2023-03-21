<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function($data, $message, $status_code){
            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        Response::macro('error', function($message, $status_code){
            return response()->json([
                'message' => $message,
            ], $status_code);
        });

        Response::macro('loggedOut', function(){
            return response()->json([
                'message' => 'logged out.',
            ], 200);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Builder;

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
        Builder::macro('whereLike', function(string $column, string $search) {
            return $this->orWhere($column, 'LIKE', '%'.$search.'%');
         });
         
        Response::macro('info', function($message, $status_code){
            return response()->json([
                'message' => $message
            ], $status_code);
        });

        Response::macro('success', function($data, $message, $status_code){
            return response()->json([
                'message' => $message,
                'data' => $data,
            ], $status_code);
        });

        Response::macro('loggedOut', function(){
            return response()->json([
                'message' => 'logged out.',
            ], 200);
        });
    }
}

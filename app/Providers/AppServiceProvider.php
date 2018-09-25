<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        Validator::extend('uniqueYearAndMonth', function ($attribute, $value, $parameters, $validator) {
            $count = DB::table('submissions')->where('year', $value)
                                        ->where('month', $parameters[0])
                                        ->where('organization_id', $parameters[1])
                                        ->count();
        
            return $count === 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

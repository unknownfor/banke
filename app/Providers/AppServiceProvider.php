<?php

namespace App\Providers;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //增加手机号格式验证规则
        Validator::extend('mobile', function($attribute, $value, $parameters, $validator) {
            if(!empty($value) && preg_match('/^1[34578][0-9]{9}$/', $value)){
                return true;
            }
            return false;
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

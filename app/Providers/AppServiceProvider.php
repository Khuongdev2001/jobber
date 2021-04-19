<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Model\Specialize;
use App\Model\Province;
use App\Model\CatPost;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(["candidate/job/info", "candidate/job/saveJobIndex", "candidate/job/index","candidate/user/info"], function ($view) {
            $view->with("dataSearch", [
                "specializes" => Specialize::select(["Specialize_ID", "Name"])->get(),
                "provinces" => Province::select(["Province_ID", "Province_Name"])->get()
            ]);
        });

        View::composer(["candidate/post/home","candidate/post/index","candidate/post/info"], function ($view) {
            $view->with("setMenuPost", [
                "menus" =>CatPost::select("Cat_Slug","Cat_Title","Cat_ID")->where("Is_Menu","1")->get(),
            ]);
        });
    }
}

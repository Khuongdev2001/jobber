<?php

use Illuminate\Support\Facades\Route;

if (!function_exists("setMenuActive")) {

    function setMenuActive($routeName, $page)
    {
        $className = [
            "admin" => "mm-active",
            "candidate" => "active",
            "employer" => "active"
        ];

        if (Route::is($routeName)) {
            return $className[$page];
        }
        return false;
    }
}

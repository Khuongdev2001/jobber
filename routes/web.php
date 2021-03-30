<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix("admin")->group(function () {
    Route::prefix("user")->group(function () {
        Route::get("login", "admin\UserController@login")->name("admin.user.login");
        Route::post("login", "admin\UserController@doLogin");
        Route::prefix("admin")->group(function () {
            Route::get("/", 'admin\UserController@indexAdmin')->name("admin.user.admin");
            Route::get("/get", 'admin\UserController@getIndexAdmin')->name("admin.user.admin.get");
            Route::get("add", 'admin\UserController@addAdmin')->name("admin.user.admin.add");
            Route::post("add", 'admin\UserController@doAddAdmin');
            Route::get("/info/{email}", "admin\UserController@infoAdmin")->where("id", "[0-9]+")->name("admin.user.admin.info");
            Route::post("/update/{id}", 'admin\UserController@updateAdmin')->where("id", "[0-9]+")->name("admin.user.admin.update");
            Route::get("block/{id}", 'admin\UserController@block')->where("id", "[0-9]+")->name("admin.user.admin.block");
            Route::post("upload/image/{id}", 'admin\UserController@uploadImageAdmin')->where("id", "[0-9]+")->name("admin.user.admin.upload.image");
            Route::get("delete", 'admin\UserController@delete')->name("admin.user.admin.delete");
        });

        Route::prefix("candidate")->group(function () {
            Route::get("/", 'admin\UserController@indexCandidate')->name("admin.user.candidate");
            Route::get('/get', 'admin\UserController@getIndexCandidate')->name("admin.user.candidate.get");
            Route::get("block/{id}", "admin\UserController@block")->where("id", "[0-9]+")->name("admin.user.candidate.block");
            Route::get("delete", 'admin\UserController@delete')->name("admin.user.candidate.delete");
            Route::get("active/{id}", "admin\UserController@active")->name("admin.user.candidate.active");
            Route::get("info/{email}", "admin\UserController@infoCandidate")->name("admin.user.candidate.info");
        });

        Route::prefix("employer")->group(function () {
            Route::get("/", "admin\UserController@indexEmployer")->name("admin.user.employer");
            Route::get("/get", "admin\UserController@getIndexEmployer")->name("admin.user.employer.get");
            Route::get("active/{id}", "admin\UserController@active")->name("admin.user.employer.active");
            Route::get("info/{email}", "admin\UserController@infoEmployer")->name("admin.user.employer.info");
            Route::get("/block/{id}", "admin\UserController@block")->name("admin.user.employer.block");
        });
    });
});

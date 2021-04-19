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

Route::group(["prefix" => "admin"], function () {
    Route::get("user/login", "admin\UserController@login")->name("admin.user.login");
    Route::post("user/login", "admin\UserController@doLogin");
    Route::middleware(["CheckLoginAdmin"])->group(function () {
        Route::prefix("user")->group(function () {
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
                Route::get("confirm/company/{id}", "admin\UserController@confirmCompany")->name("admin.user.employer.confirm");
                Route::get("delete", "admin\UserController@delete")->name("admin.user.employer.delete");
                Route::get("service", "admin\EmployerController@service")->name("admin.employer.service");
                Route::get("service/get", "admin\EmployerController@getService")->name("admin.employer.service.get");
                Route::get("service/set/status/{code}/{status}", "admin\EmployerController@setStatusService")->name("admin.employer.service.set.status")->where("status", "[1,2]");
                Route::get("job", "admin\EmployerController@job")->name("admin.employer.job");
                Route::get("job/get", "admin\EmployerController@getJob")->name("admin.employer.job.get");
                Route::get("job/info/{id?}", "admin\EmployerController@jobInfo")->name("admin.employer.job.info");
                Route::get("job/confirm/{id}/{status}", "admin\EmployerController@confirmJob")->name("admin.employer.job.confirm")->where("status", "[3-4]");
            });
        });
        Route::prefix("post")->group(function () {
            Route::prefix("cat")->group(function () {
                Route::get("/", "admin\PostController@indexCat")->name("admin.post.cat");
                Route::get("get", "admin\PostController@getIndexCat")->name("admin.post.cat.get");
                Route::get("set/menu/{id}", "admin\PostController@setMenu")->name("admin.post.set.menu")->where("id", "[0-9]+");
                Route::post("update/{id}", "admin\PostController@updateCat")->name("admin.post.cat.update")->where("id", "[0-9]+");
                Route::post("add", "admin\PostController@addCat")->name("admin.post.cat.add");
                Route::get("delete/{id}", "admin\PostController@deleteCat")->name("admin.post.cat.delete")->where("id", "[0-9]+");
                Route::get("search", "admin\PostController@searchSelect2Cat")->name("admin.post.cat.searchselect2");
            });
            Route::post("add/tag", "admin\PostController@addTag")->name("admin.post.tag.add");
            Route::get("tag/search", "admin\PostController@searchSelect2Tag")->name("admin.post.tag.searchselect2");
            Route::get("add", "admin\PostController@addPost")->name("admin.post.add");
            Route::post("add", "admin\PostController@doAddPost");
            Route::get("update/{slug}", "admin\PostController@updatePost")->name("admin.post.update");
            Route::post("update/{slug}", "admin\PostController@doUpdatePost");
            Route::get("/", "admin\PostController@indexPost")->name("admin.post");
            Route::get("/get", "admin\PostController@getIndexPost")->name("admin.post.get");
            Route::get("/hidden/{id}", "admin\PostController@hiddenPost")->name("admin.post.hidden")->where("id", "[0-9]+");
            Route::get("delete", "admin\PostController@delete")->name("admin.post.delete");
        });
        // chưa viết trên google sheet
        // cần fix lại vì đổi database 
        Route::prefix("package")->group(function () {
            Route::get("config", "admin\PackageController@config")->name("admin.package.config");
            Route::post("post/update", "admin\PackageController@updatePackagePost")->name("admin.package.post.update");
            Route::post("fitlter/update", "admin\PackageController@updateFitlterPost")->name("admin.package.fitlter.update");
        });
        // chưa viết trên google sheet
        // Chưa áp dụng được
        Route::prefix("config")->group(function () {
            Route::prefix("contact")->group(function () {
                Route::get("/", "admin\ConfigController@indexContact")->name("admin.config.contact");
                Route::get("/get", "admin\ConfigController@getIndexContact")->name("admin.config.contact.get");
                Route::get("/block/{id}", "admin\ConfigController@blockContact")->name("admin.config.contact.block");
                Route::get("/delete", "admin\ConfigController@deleteContact")->name("admin.config.contact.delete");
            });
        });
    });
    Route::get("dashboard", "admin\DashboardController@index")->name("admin.dashboard");
});

Route::group(["prefix" => "nha-tuyen-dung"], function () {
    Route::get("dang-ky", "employer\UserController@reg")->name("employer.reg");
    Route::post("dang-ky", "employer\UserController@doReg");
    Route::post("dang-nhap", "employer\UserController@doLogin")->name("employer.login");
    Route::post("quen-mat-khau", "employer\UserController@forget")->name("employer.forget");
    Route::get("quen-mat-khau", "employer\UserController@doForget");
    Route::get("kich-hoat", "employer\UserController@active")->name("employer.active");
    Route::get("/", "employer\HomeController@index")->name("employer.home");
    Route::get("danh-sach-nghanh", "employer\DataController@getSpecialize")->name("employer.data.specialize");
    Route::get("danh-sach-tinh-thanh", "employer\DataController@getProvince")->name("employer.data.province");
    Route::group(["middleware" => ["CheckLoginEmployer"]], function () {
        Route::get("geetest", "Auth\AuthController@getGeeTest");
        Route::get("dang-xuat", "employer\UserController@logout")->name("employer.logout");
        Route::get("ban-than", "employer\UserController@info")->name("employer.info");
        Route::post("ban-than", "employer\UserController@doUpdate")->name("employer.update");
        Route::post("upload", "employer\UserController@uploadImageEmployer")->name("employer.upload");
        Route::post("changePassword", "employer\UserController@changePassword")->name("employer.changePassword");
        Route::get("thong-tin-cong-ty", "employer\CompanyController@info")->name("employer.company.info");
        Route::post("thong-tin-cong-ty", "employer\CompanyController@updateInfo")->name("employer.company.update");
        Route::get("goi-dich-vu", "employer\ProductController@buy")->name("employer.product.buy");
        Route::post("them-don-hang", "employer\ProductController@addProduct")->name("employer.product.addProduct");
        Route::get("them-don-hang", "employer\ProductController@doAddProduct");
        Route::post("kich-hoạt-san-pham", "employer\ProductController@activeProduct")->name("employer.product.active");
        Route::get("trang-tong-quan", "employer\DashboardController@index")->name("employer.dashboard");
        Route::get("dang-tin-tuyen-dung", "employer\JobController@add")->name("employer.job.add");
        Route::post("dang-tin-tuyen-dung", "employer\JobController@doAdd");
        Route::get("danh-sach-tin-tuyen-dung/{option?}", "employer\JobController@index")->name("employer.job");
        Route::get("thao-tac-tin-tuyen-dung/{id}/{status}", "employer\JobController@action")->name("employer.job.action");
        Route::get("cap-nhat-tin-dang/{slug}", "employer\JobController@update")->name("employer.job.update");
        Route::post("cap-nhat-tin-dang/{slug}", "employer\JobController@doUpdate");
        Route::get("lich-su", "employer\HistoryController@index")->name("employer.history");
        Route::get("ung-vien", "employer\CandidateController@index")->name("employer.candidate");
        Route::get("luu-ung-vien/{id}/{status}", "employer\CandidateController@editCandidateSave")->where("status", "[0-1]+")->name("employer.candidate.save.option");
        Route::get("ung-vien-da-luu", "employer\CandidateController@candidateSave")->name("employer.candidate.save");
        Route::get("loc-ho-so-ung-vien/{id}", "employer\CandidateController@candidateInfo")->name("employer.filter.candidate");
        Route::get("danh-sach-ung-vien-ung-tuyen/{id}", "employer\CandidateController@candidateApply")->name("employer.candidate.apply");
        Route::get("xac-nhan-ung-tuyen-cong-viec/{job}/{candidate}/{status}", "employer\CandidateController@editCandidateApply")->name("employer.candidate.apply.edit")->where("status", "[1-2]");
    });
});

Route::get("dang-ky.html", "candidate\UserController@reg")->name("reg");
Route::post("dang-ky.html", "candidate\UserController@doReg");
Route::get("kich-hoat.html", "candidate\UserController@active")->name("active");
Route::get("dang-nhap", "candidate\UserController@login")->name("login");
Route::post("dang-nhap", "candidate\UserController@doLogin");
Route::get("dang-nhap/facebook.html", "candidate\UserController@loginFacebook")->name("login.facebook");
Route::get("dang-nhap/callback/facebook.html", "candidate\UserController@callbackFacebook")->name("login.callback.facebook");
Route::get("dang-xuat.html", "candidate\UserController@logout")->name("logout");
Route::get("p/{email?}", "candidate\UserController@info")->name("info");
Route::post("p/{email?}", "candidate\UserController@updateInfo");
Route::post("p/upload/image/{cover?}", "candidate\UserController@uploadImage")->name("upload.image");
Route::post("p/upload/cv", "candidate\UserController@uploadCv")->name("upload.cv");
Route::get("p/upload/cv", "candidate\UserController@uploadCv")->name("upload.cv");
Route::get("p/cv/action/{id}/{option}", "candidate\UserController@actionCv")->name("action.cv")->where("option", "[0-2]+");
Route::get("cong-ty", "candidate\CompanyController@index")->name("company");
Route::get("cong-ty/{slug?}", "candidate\CompanyController@info")->name("company.info");
Route::get("/", "candidate\HomeController@index")->name("home");
Route::get("ajax-get-job/service/{type}", "candidate\HomeController@getJobService")->name("ajax.job.service");
Route::get("ajax-get-job/type/{type}", "candidate\HomeController@getJobType")->name("ajax.job.type");
Route::get("viec-lam/{slug}", "candidate\JobController@info")->name("job.info");
Route::get("them-viec-lam-da-luu/{id}/{status?}", "candidate\JobController@editJobSave")->name("jobSave.option")->where("status", "[0-1]+");
Route::get("danh-sach-viec-lam-da-luu", "candidate\JobController@JobSave")->name("jobSave");
Route::get("viec-lam", "candidate\JobController@job")->name("job");
Route::get("ung-tuyen/{id}", "candidate\JobController@applyJob")->name("job.apply");
Route::get("trang-chu-bai-viet", "candidate\PostController@home")->name("post.home");
Route::get("bai-viet", "candidate\PostController@index")->name("post");
Route::get("bai-viet/{slug}", "candidate\PostController@info")->name("post.info");

@extends("employer.master.layout")
@section("title","Trang chủ Jobber")
@section("modal-login")
@parent
@endsection
@section("css")
{{-- css effect animate --}}
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.0/dist/aos.css">
<link rel="stylesheet" type="text/css" href="{{ asset("employer/plugins/animate/css/animate.css") }}">
{{-- css carousel --}}
<link rel="stylesheet" href="{{ asset("employer/plugins/carousel/css/owl.carousel.min.css") }} "/>
@endsection

@section("js")
{{-- js effect animate --}}
<script src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>
{{-- js carousel --}}
<script src="{{ asset("employer/plugins/carousel/js/owl.carousel.min.js") }}"></script>

@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<section class="clearfix slider-banner">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="img-fluid" src="{{ asset("employer/img/banner/banner-01.jpg") }}" alt="">
                <div class="slider-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 justify-content-center text-center">
                                <h2 class="text-white animated-08"><u>The Hunt Uy tín</u></h2>
                                <h1 class="text-white animated-08">5,000+ Công việc</h1>
                                <h6 class="mb-2 font-weight-normal text-white animated-08">The Hunt Thuộc top 20 web site có lượng truy cập nhiều nhất trong ngày </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="{{ asset("employer/img/banner/banner-02.jpg") }}" alt="">
                <div class="slider-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 justify-content-center text-center">
                                <h2 class="text-white animated-08"><u>You deserve it</u></h2>
                                <h1 class="text-white animated-08">Get your dream job</h1>
                                <h6 class="mb-2 font-weight-normal text-white animated-08">This is perhaps the single biggest obstacle that all of us must overcome in order to be successful.</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-link animated-08">View more <i class="fas fa-arrow-right pl-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!--=================================
Banner -->


<!--=================================
Feature box -->
<section class="space-ptb overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12 justify-content-center">
                <div class="section-title center">
                    <h2 class="title">Các gói dịch vụ của chúng tôi</h2>
                    <p>Các gói dịch vụ này sẽ góp phần cải thiện cho doanh số tuyển dụng công ty bạn</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
Feature box -->

<!--=================================
Companies Detail  -->
<section class="space-ptb bg-light">
    <div class="container overflow-hidden">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title float-right">
                    <h2 class="title">Gói quảng bá thương hiệu</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-left">
            <div class="col-md-12">
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-lg-7">
                            <div class="companies-info d-sm-flex">
                                <div class="companies-details">
                                    <div class="companies-name">
                                        <div class="d-flex mb-3">
                                            <div class="employers-list-option">
                                                <h5>Tại sao cần mua gói Quảng bá thương hiệu</h5>
                                            </div>
                                        </div>
                                        <p> Trang chủ chúng tôi nhận được hơn 7 triệu lượt truy cập mỗi tháng từ các ứng viên và chuyên gia giỏi nhất tại Việt Nam
                                            Đặt Logo và Banner tại trang chủ sẽ là vị trí chiến lược để thu hút nhân tài</p>
                                        <a href="#" class="btn btn-outline-primary">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5">
                            <div class="companies-img p-2">
                                <img class="img-fluid" src="https://employer.vietnamworks.com/v2/img/gallery/home-offer-3.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
Companies Detail  -->


<!--=================================
Employers package post job  -->
<section class="space-ptb bg-holder bg-overlay-black-50 overflow-hidden" style="background-image: url(employer/img/bg/05.jpg); ">
    <div class="container">
        <div class="row align-items-center" data-aos="fade-right">
            <div class="col-lg-5">
                <div class="section-title mb-lg-0">
                    <h2 class="title text-white">Gói đăng tin tuyển dụng</h2>
                    <p class="mb-0 text-white">Chúng tôi hiện cung cấp 7 gói cho phần tuyển dụng nhằm phục vụ nhu cầu cùa công ty</p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="owl-carousel owl-nav-bottom-center" data-nav-arrow="false" data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="2" data-xs-items="2" data-xx-items="1" data-space="15" data-autoheight="true">
                    <div class="item">
                        <div class="employers-grid bg-white">
                            <div class="employers-list-logo">
                                <img class="img-fluid" src="{{ asset("employer/img/svg/07.svg") }}" alt="">
                            </div>
                            <div class="employers-list-details">
                                <div class="employers-list-info">
                                    <div class="employers-list-title">
                                        <h5 class="mb-0"><a href="job-detail.html">Gói cơ bản</a></h5>
                                    </div>
                                    <div class="employers-list-option">
                                        <ul class="list-unstyled">
                                            <li>Gói đăng tin sẽ không hiển thị ở các khung ngoài trang chủ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="employers-list-position">
                                <a class="btn btn-sm btn-dark" href="#">1 tin/30 ngày</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="employers-grid bg-white">
                            <div class="employers-list-logo">
                                <img class="img-fluid" src="{{ asset("employer/img/svg/08.svg") }}" alt="">
                            </div>
                            <div class="employers-list-details">
                                <div class="employers-list-info">
                                    <div class="employers-list-title">
                                        <h5 class="mb-0"><a href="#">Việc làm mới nhất</a></h5>
                                    </div>
                                    <div class="employers-list-option">
                                        <ul class="list-unstyled">
                                            <li>Tin đăng sẽ hiển thị ở khung việc làm mới nhất</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="employers-list-position">
                                <a class="btn btn-sm btn-dark" href="#">1 tin/7ngày</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="employers-grid bg-white">
                            <div class="employers-list-logo">
                                <img class="img-fluid" src="{{ asset("employer/img/svg/09.svg")}}" alt="">
                            </div>
                            <div class="employers-list-details">
                                <div class="employers-list-info">
                                    <div class="employers-list-title">
                                        <h5 class="mb-0"><a href="job-detail.html">Gói việc làm hấp dẫn</a></h5>
                                    </div>
                                    <div class="employers-list-option">
                                        <ul class="list-unstyled">
                                            <li></i>Tin sẽ hiển thị ở khung việc làm hấp dẫn trang chủ</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="employers-list-position">
                                <a class="btn btn-sm btn-dark" href="#">1 tin/7 ngày</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="employers-grid bg-white">
                            <div class="employers-list-logo">
                                <img class="img-fluid" src="{{ asset("employer/img/svg/10.svg") }}" alt="">
                            </div>
                            <div class="employers-list-details">
                                <div class="employers-list-info">
                                    <div class="employers-list-title">
                                        <h5 class="mb-0"><a href="job-detail.html">Gói việc làm lương cao</a></h5>
                                    </div>
                                    <div class="employers-list-option">
                                        <ul class="list-unstyled">
                                            <li>Tin đăng sẽ hiển thị ở khung việc làm lương cao</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="employers-list-position">
                                <a class="btn btn-sm btn-dark" href="#">1 tin/7 ngày</a>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="employers-grid bg-white">
                            <div class="employers-list-logo">
                                <img class="img-fluid" src="{{ asset("employer/img/svg/15.svg") }}" alt="">
                            </div>
                            <div class="employers-list-details">
                                <div class="employers-list-info">
                                    <div class="employers-list-title">
                                        <h5 class="mb-0"><a href="job-detail.html">Gói việc làm cấp quản lý</a></h5>
                                    </div>
                                    <div class="employers-list-option">
                                        <ul class="list-unstyled">
                                            <li>Tin đăng sẽ hiển thị khung việc làm cấp quản lý</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="employers-list-position">
                                    <a class="btn btn-sm btn-dark" href="#">1 tin/7 ngày</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
Employers  -->

<!--=================================
Companies Detail  -->
<section class="space-ptb bg-light overflow-hidden">
    <div class="container" data-aos="fade-left">
        <div class="row">
            <div class="col-md-7">
                <div class="section-title">
                    <h2 class="title">Gói Lọc Hồ Sơ</h2>
                    <p>Giúp Bạn biết được nhiều thông tin của ứng viên mình hơn</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-5">
                            <div class="companies-img p-2">
                                <img class="img-fluid" src="https://employer.vietnamworks.com/v2/img/gallery/home-offer-2.svg" alt="">
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <div class="companies-info d-sm-flex">
                                <div class="companies-details">
                                    <div class="companies-name">
                                        <div class="d-flex mb-3">
                                            <div class="employers-list-option">
                                                <h5>Tại sao cần mua gói lọc hồ sơ? </h5>
                                            </div>
                                        </div>
                                        <p>Vì theo mặt định hệ thống bạn chỉ xem được các thông tin cơ bản. Nên để xem được chi tiết hơn bạn cần phải mua gói lọc hồ sơ</p>
                                        <a href="#" class="btn btn-outline-primary">Chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
Companies Detail  -->

<!--=================================
Top Companies  -->
<section class="space-ptb employers-box overflow-hidden">
    <div class="container">
        <div class="row" data-aos="flip-right">
            <div class="col-md-12 justify-content-center">
                <div class="section-title center">
                    <h2 class="title">Các nhà đồng hành với chúng tôi</h2>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-lg-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/07.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trout Design Ltd</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-md-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/08.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Lawn Hopper</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-lg-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/09.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trout Design Ltd</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-md-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/10.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Lawn Hopper</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-lg-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/11.svg")}}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Rippin LLC</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-lg-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/15.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trophy and Sons</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-md-0 pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/13.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Lawn Hopper</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-lg-0 pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/14.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Rippin LLC</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-sm-0 pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/12.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trout Design Ltd</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-sm-0 pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/16.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trophy and Sons</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid mb-3 mb-sm-0 pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/17.svg") }}" alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Lawn Hopper</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="employers-grid pb-0">
                    <div class="employers-list-logo">
                        <img class="img-fluid" src="{{ asset("employer/img/svg/18.svg") }} " alt="">
                    </div>
                    <div class="employers-list-details">
                        <div class="employers-list-info">
                            <div class="employers-list-title">
                                <h6 class="mb-0"><a href="job-detail.html">Trout Design Ltd</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
Top Companies  -->

<!--=================================
How it works  -->
<section class="space-pt bg-holder" style="background-image: url(public/employer/img/bg/06.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="section-title center">
                    <h2 class="title">How it works?</h2>
                    <p>I truly believe Augustine’s words are true and if you look at history you know it is true. There are many people in the world with amazing talents who realize only a small percentage of their potential. We all know people who live this truth.</p>
                </div>
                <div class="text-center">
                    <a href="#" class="btn btn-white btn-lg">Read More</a>
                </div>
                <div class="text-center" data-aos="zoom-in">
                </div>
            </div>
        </div>
    </div>
</section>
<!--=================================
How it works  -->

<!--=================================
Google ply  -->
<section class="py-4 py-md-5 bg-light overflow-hidden">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="d-block d-sm-flex">
                    <a class="btn btn-white btn-sm btn-app mr-0 mr-sm-2 mb-2 mb-sm-0 py-2" href="#">
                        <i class="fab fa-apple"></i>
                        <div class="btn-text text-left">
                            <small>Download on the </small>
                            <span class="mb-0 d-block">App Store</span>
                        </div>
                    </a>
                    <a class="btn btn-white btn-sm btn-app mb-2 mb-sm-0 py-2" href="#">
                        <i class="fab fa-google-play"></i>
                        <div class="btn-text text-left">
                            <small>Get it on </small>
                            <span class="mb-0 d-block">Google Play</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ml-auto mt-3 mt-lg-0">
                    <h6 class="mb-0">Get best glimpse app for mobile and other small devices from play store</h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
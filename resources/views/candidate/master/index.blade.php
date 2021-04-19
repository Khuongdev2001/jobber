<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Favicon -->
    <link href="{{ asset("employer/img/logo.svg") }}" rel="shortcut icon" />
    <title>@yield("title")</title>
    <link rel="stylesheet" href="{{ asset("candidate/framework/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,500,700">
    <link rel="stylesheet" href="{{ asset("candidate/fonts/fontawesome/css/all.css") }}">
    <link rel="stylesheet" href="{{ asset("candidate/css/line-icons.css") }}">
    <link rel="stylesheet" href="{{ asset("candidate/css/slicknav.min.css")}}" >
    <link rel="stylesheet" href="{{ asset("candidate/plugin/animate/css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("candidate/css/main.css") }}">
    <link rel="stylesheet" href="{{ asset("candidate/css/responsive.css") }}">
    {{-- plugin notification --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/notifications/css/lobibox.min.css") }}">
    @yield("css")
</head>

<body>
@include("candidate/include/header")
@yield("content")   
<footer>
    <div id="subscribe" class="section bg-cyan">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="subscribe-form">
                        <div class="form-wrapper">
                            <div class="sub-title">
                                <h3>Subscribe Our Newsletter</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ellentesque dignissim quam et metus dolor sit amet,.</p>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-12 form-line">
                                        <div class="form-group form-search">
                                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
                                            <button type="submit" class="btn btn-common btn-search">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="img-sub">
                        <img class="img-fluid" src="https://preview.uideck.com/items/thehunt/assets/img/sub.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="footer-Content">
        <div class="container">
            <ul id="list-key-seach-post">
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>
                <li class="item"><a href="">cv là g</a></li>

            </ul>
        </div>
    </section>
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info text-center">
                        Nguyễn Hữu Khương
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>
<a id="chat-support" class="dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fab fa-facebook-messenger"></i>
</a>
<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<script src="{{ asset("candidate/library/jquery/js/jquery-min.js") }}"></script>
<script src="{{ asset("candidate/framework/bootstrap/js/popper.min.js") }}"></script>
<script src="{{ asset("candidate/framework/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("candidate/js/color-switcher.js") }}"></script>
<script src="{{ asset("candidate/plugin/carousel/js/owl.carousel.min.js") }}"></script>
<script src="{{ asset("candidate/library/jquery/js/jquery.slicknav.js") }}"></script>
<script src="{{ asset("candidate/library/jquery/js/jquery.counterup.min.js") }}"></script>
<script src="{{ asset("candidate/js/waypoints.min.js") }}"></script>
<script src="{{ asset("candidate/js/form-validator.min.js") }}"></script>
<script src="{{ asset("candidate/js/contact-form-script.js") }}"></script>
<!-- plugin lazy loading -->
<script src="{{ asset("candidate/js/main.js") }}"></script>
{{-- plugin notification --}}
<script src="{{ asset("admin/plugins/notifications/js/lobibox.min.js") }}"></script>
<script src="{{ asset("admin/plugins/notifications/js/notifications.min.js") }}"></script>
<script src="{{ asset("admin/plugins/notifications/js/notification-custom-script.js") }}"></script>
    {{-- notification --}}
    @if ($errors->any() || session("error") || session("success"))
    <script>
        @foreach ($errors->all() as $error)
              error_noti({ title:"Lỗi Người Dùng", message:"{{ $error }}"})
        @endforeach

        @if(session("error"))
            error_noti({ title:"{{ session('error.title') }}", message:"{{ session('error.message') }}"})
        @endif        

        @if(session("success"))
            success_noti({title:"{{ session('success.title') }}",message:"{{ session('success.message') }}"} )
        @endif
    </script>  
    @endif
    <script>
    $(document).on("click", "#btn-open-seach-advanced", function() {
        $(this).attr("id", "btn-close-seach-advanced");
        $(this).text("Đóng tìm kiếm nâng cao")
        $(".job-search-form .seach-adanced").append(`<div class="row"><div class="col-md-3"><div class="form-group"><div class="search-category-container"><label class="styled-select"></label></div></div></div><div class="col-md-3"><div class="form-group"><div class="search-category-container"><label class="styled-select"><select name="Job_Type">
            @foreach(__("user.Job_Type") as $key=>$item)
                <option value="{{ $key }}">{{$item}}</option>
            @endforeach
            </select></label></div><i class = "far fa-clock"></i></div></div><div class = "col-md-3" ><div class = "form-group" ><div class = "search-category-container" ><label class="styled-select">
                <select name="Experience">
            @foreach(__("user.Experience") as $key=>$item)
                <option value="{{ $key }}">{{$item}}</option>
            @endforeach
            </select>
            </label></div> <i class = "far fa-building" ></i></div></div></div>`)
    })
    $(document).on("click", "#btn-close-seach-advanced", function() {
        $(this).attr("id", "btn-open-seach-advanced");
        $(this).text("Chọn tìm kiếm nâng cao")
        $(".job-search-form .seach-adanced").empty();
    })
    </script>
@yield("js")
</body>

</html>
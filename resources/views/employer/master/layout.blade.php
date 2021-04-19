
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <!-- Favicon -->
    <link href="{{ asset("employer/img/logo.svg") }}" rel="shortcut icon" />
    {{-- google font  --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <!-- CSS Global Compulsory (Do not remove)-->
    <link rel="stylesheet" href="{{ asset("employer/fonts/fontawesome/css/all.css") }}" />
    <link rel="stylesheet" href="{{ asset("employer/css/flaticon.css") }}" />
    <link rel="stylesheet" href="{{ asset("employer/framework/bootstrap/css/bootstrap.min.css") }}" />
    <!-- Template Style -->
    <link rel="stylesheet" href="{{ asset("employer/css/style.css") }}" />
    <!-- plugin css select -->
    {{-- plugin notification --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/notifications/css/lobibox.min.css") }}">
    @yield("css")
</head>
<body class="">
{{-- header --}}
@section("header")
{{-- header when login done --}}
@show
{{-- end header --}}
@yield("content")


{{-- footer --}}
<footer class="footer mt-0">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">For Candidates</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Browse Jobs</a></li>
                        <li><a href="#">Browse Categories</a></li>
                        <li><a href="#">Submit Resume</a></li>
                        <li><a href="#">Candidate Dashboard</a></li>
                        <li><a href="#">Job Alerts</a></li>
                        <li><a href="#">My Bookmarks</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">For Employers</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Browse Candidates</a></li>
                        <li><a href="#">Browse Categories</a></li>
                        <li><a href="#">Employer Dashboard</a></li>
                        <li><a href="#">Add Job</a></li>
                        <li><a href="#">Job Packages</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">Partner Sites</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Shortcodes</a></li>
                        <li><a href="#">Job Page</a></li>
                        <li><a href="#">Job Page Alternative </a></li>
                        <li><a href="#">Resume Page</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-contact-info bg-holder" style="background-image: url(images/google-map.png);">
                    <h5 class="text-dark mb-4">Contact Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li> <i class="fas fa-map-marker-alt text-primary"></i><span>214 West Arnold St. New York, NY 10002</span> </li>
                        <li> <i class="fas fa-mobile-alt text-primary"></i><span>+(123) 345-6789</span> </li>
                        <li> <i class="far fa-envelope text-primary"></i><span>support@jobber.demo</span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="border-bottom"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center text-md-left">
                    <p class="mb-0"> &copy;Copyright <span id="copyright">
                            <script>
                                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                            </script>
                        </span> <a href="#"> Jobber </a> All Rights Reserved </p>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="social d-flex justify-content-lg-end justify-content-center">
                        <ul class="list-unstyled">
                            <li class="facebook"><a href="#">FB</a></li>
                            <li class="twitter"><a href="#">TW</a></li>
                            <li class="linkedin"><a href="#">IN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@section("modal-login")
<div class="modal fade model-login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h4 class="mb-0 text-center">Tác vụ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login-register">
                    <fieldset>
                        <legend class="px-2">Chọn loại tác vụ</legend>
                        <ul class="nav nav-tabs nav-tabs-border d-flex" role="tablist">
                            <li class="nav-item mr-4">
                                <a class="nav-link active" data-toggle="tab" href="#box-login" role="tab" aria-selected="false">
                                    <div class="d-flex">
                                        <div class="ml-3">
                                            <h6 class="mb-0">Đăng nhập</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#box-forget-pass" role="tab" aria-selected="false">
                                    <div class="d-flex">
                                        <div class="ml-3">
                                            <h6 class="mb-0">Quên mật khẩu</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </fieldset>
                    <div class="tab-content">
                        <div class="tab-pane active" id="box-login" role="tabpanel">
                            <form class="mt-4" method="Post" action="{{ route("employer.login") }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="User_Email">Email:* </label>
                                        <input type="text" class="form-control" id="User_Email" value="{{ old("User_Email") }}" name="User_Email">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="User_Password">Password:* </label>
                                        <input type="password" class="form-control" id="User_Password" name="User_Password">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" href="#">Đăng nhập</button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ml-md-3 mt-3 mt-md-0 forgot-pass">
                                            <p class="mt-1">Bạn chưa có tài khoản <a href="{{ route("employer.reg") }}">Đăng ký</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="box-forget-pass" role="tabpanel">
                            <form class="mt-4" action="{{ route("employer.forget") }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="Email2">Email:</label>
                                        <input type="text" class="form-control" id="User_Email" value="{{ old("User_Email") }}" name="User_Email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block" href="#">Xác nhận</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@show


{{-- end footer --}}
{{-- back to top --}}
<div id="back-to-top" class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>
{{-- end back to top --}}
{{-- javascript --}}
{{-- main js no remove --}}
<script src="{{ asset("employer/library/jquery/js/jquery-min.js") }} "></script>
<script src="{{ asset("employer/framework/bootstrap/js/popper.min.js") }}"></script>
<script src="{{ asset("employer/framework/bootstrap/js/bootstrap.min.js") }}"></script>

{{-- plugin notification --}}
<script src="{{ asset("admin/plugins/notifications/js/lobibox.min.js") }}"></script>
<script src="{{ asset("admin/plugins/notifications/js/notifications.min.js") }}"></script>
<script src="{{ asset("admin/plugins/notifications/js/notification-custom-script.js") }}"></script>
<!-- Template Scripts (Do not remove)-->
<script src="{{ asset("employer/js/custom.js") }}"></script>
<script src="{{ asset("employer/js/main.js") }}"></script>
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
@yield("js")
</body>

</html>
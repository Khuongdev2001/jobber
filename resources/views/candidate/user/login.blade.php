@extends("candidate.master.index")
@section("title","Đăng nhập tài khoản")
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<section id="content" class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-xs-12">
                <div class="page-login-form box">
                    <h3>
                        Đăng nhập
                    </h3>
                    <form class="login-form" action="{{route("login")}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" id="sender-email" value="{{ old("User_Email") }}" class="form-control" name="User_Email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" class="form-control" name="User_Password" placeholder="Mật khẩu">
                            </div>
                        </div>
                        <button class="btn btn-common log-btn">Đăng nhập</button>
                        <div class="box-login-option">
                            <a href="{{ route("login.facebook") }}" class="btn-login-option" id="btn-login-facebook"><span><i class="fab fa-facebook-f"></i></span>Đăng nhập facebook</a>
                            <a href="" class="btn-login-option" id="btn-login-google"><span><i class="fab fa-google"></i></span>Đăng nhập google</a>
                        </div>
                    </form>
                    <ul class="form-links">
                        <li class="text-center"><a href="{{ route("reg") }}">Bạn chưa có tài khoản?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

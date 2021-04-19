@extends("candidate.master.index")
@section("title","Đăng ký tài khoản")
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
                        Đăng ký
                    </h3>
                    <form class="login-form" method="POST" action="{{ route("reg") }}">
                        @csrf
                        <div class="form-group @error("Fullname") form-error @enderror">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" id="Fullname" class="form-control " value="{{ old("Fullname") }}" name="Fullname" placeholder="Tên">
                            </div>
                            @error("Fullname")
                                <small class="message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group  @error("User_Email") form-error @enderror">
                            <div class="input-icon">
                                <i class="lni-user"></i>
                                <input type="text" id="User_Email" class="form-control" value="{{ old("User_Email") }}" name="User_Email" placeholder="Email">
                            </div>
                            @error("User_Email")
                                <small class="message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error("User_Password") form-error @enderror">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" name="User_Password" class="form-control" placeholder="Mật khẩu">
                            </div>
                            @error("User_Password")
                            <small class="message">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group @error("Re_User_Password") form-error @enderror">
                            <div class="input-icon">
                                <i class="lni-lock"></i>
                                <input type="password" name="Re_User_Password" class="form-control" placeholder="Xác Nhận Mật khẩu">
                            </div>
                            @error("Re_User_Password")
                            <small class="message">{{ $message }}</small>
                            @enderror
                        </div>
                        <button class="btn btn-common log-btn">Đăng ký</button>
                        <div class="box-login-option">
                            <a href="" class="btn-login-option" id="btn-login-facebook"><span><i class="fab fa-facebook-f"></i></span>Đăng nhập facebook</a>
                            <a href="" class="btn-login-option" id="btn-login-google"><span><i class="fab fa-google"></i></span>Đăng nhập google</a>
                        </div>
                    </form>
                    <ul class="form-links">
                        <li class="text-center"><a href="{{ route("login") }}">Bạn Đã có tài khoản?</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>    
@endsection

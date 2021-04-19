@extends("employer.master.layout")
@section("title","Đăng ký tài khoản nhà tuyển dụng")
@section("modal-login")
@parent
@endsection
@section("css")
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
@endsection

@section("js")
    {{-- select 2 --}}
    <script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
    <script>
        $('#Specialize_ID').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("employer.data.specialize") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {Name: params.term};
            },
            processResults: function (data, params) {
                return {results: $.map(data, function (item) {return {text: item.Name,id: item.Specialize_ID,data: item};})
                };
            }
        }
    });
    </script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div id="box-reg" class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="title py-3">Đăng ký nhà tuyển dụng</h3>
        </div>
        <div class="col-md-8 box-left box-form mb-4">
            <form action="{{ route("employer.reg") }}" id="form-reg" method="post">
                @csrf
                <div class="login-info py-4 border-bottom border-primary">
                    <h5 class="title pb-4 ">Thông tin đăng nhập</h5>
                    <div class="form-group @error("Fullname") form-error @enderror">
                        <label for="Fullname">Họ và tên: *</label>
                        <input type="text" id="Fullname" class="form-control" value="{{ old("Fullname") }}" name="Fullname">
                        @error("Fullname")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error("User_Email") form-error @enderror">
                        <label for="User_Email">Email: *</label>
                        <input type="text" id="User_Email" class="form-control" value="{{ old("User_Email") }}" name="User_Email">
                        <small class="note font-italic">Jobber khuyến nghị đăng ký bằng email công ty (theo tên miền website công ty) để được hỗ trợ duyệt tin nhanh & đăng tin không giới hạn.</small>
                        @error("User_Email")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error("User_Password") form-error @enderror">
                        <label for="User_Password">Mật khẩu: *</label>
                        <input type="password" id="User_Password" class="form-control" name="User_Password">
                        @error("User_Password")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error("Re_User_Password") form-error @enderror">
                        <label for="Re_User_Password">Mật khẩu xác nhận: *</label>
                        <input type="password" id="Re_User_Password" class="form-control" name="Re_User_Password">
                        @error("Re_User_Password")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="company-info py-3">
                    <h5 class="title py-4">Thông tin tuyển dụng</h5>
                    <div class="form-group @error("Company_Name") form-error @enderror">
                        <label for="Company_Name">Tên công ty: </label>
                        <input type="text" id="Company_Name" class="form-control" value="{{ old("Company_Name") }}" name="Company_Name">
                        @error("Company_Name")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error("Specialize_ID") form-error @enderror">
                        <label for="Specialize_ID">Lĩnh vực kinh doanh: </label>
                        <select name="Specialize_ID" class="form-control" id="Specialize_ID">
                            <option value="">Chọn lĩnh vực</option>
                        </select>
                        @error("Specialize_ID")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group @error("Company_Address") form-error @enderror">
                        <label for="Company_Address">Địa chỉ: </label>
                        <input type="text" id="Company_Address" class="form-control" value="{{ old("Company_Address") }}" name="Company_Address">
                        @error("Company_Address")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- gender -->
                    <div class="form-group  @error("Gender") form-error @enderror">
                        <label for="">Giới tính: *</label>
                        <div class="custom-control custom-checkbox d-flex">
                            <div class="check-male pr-5">
                                <input type="checkbox" class="custom-control-input" id="male" value="0" name="Gender">
                                <label class="custom-control-label" for="male">Nam</label>
                            </div>
                            <div class="check-female">
                                <input type="checkbox" class="custom-control-input" id="female" value="1" name="Gender">
                                <label class="custom-control-label" for="female">Nữ</label>
                            </div>
                        </div>
                        @error("Gender")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- end gender -->
                </div>
                <div class="form-group">
                    <!-- import recaptcha -->
                    {{-- {!! Geetest::render("custom") !!} --}}
                </div>
                <!-- submit -->
                <div class="form-group">
                    <button class="btn btn-outline-primary">Đăng ký</button>
                </div>
                <!-- endsubmit -->
            </form>
        </div>
        <div class="col-md-4 box-right box-advertisement">
            <div class="box-regulation">
                <h5 class="title">Quy định Đăng ký tài khoản</h5>
                <p class="note">
                    Để đảm bảo chất lượng dịch vụ, Jobber <span class="text-dangder">không cho phép một người dùng tạo nhiều tài khoản khác nhau.</span> Nếu phát hiện vi phạm, <span class="text-danger">Jobber sẽ ngừng cung cấp dịch vụ tới tất cả các tài khoản trùng lặp hoặc chặn toàn bộ truy cập tới hệ thống website của TopCV</span>.
                    Đối với trường hợp khách hàng đã sử dụng hết 3 tin tuyển dụng miễn phí, Jobber hỗ trợ kích hoạt đăng tin tuyển dụng không giới hạn sau khi quý doanh nghiệp cung cấp thông tin giấy phép kinh doanh.
                    Mọi thắc mắc vui lòng liên hệ Hotline CSKH: (024) 7107 9799 - 0862 69 19 29
                </p>
            </div>
            <a href="" class="box-thumbnail"><img class="thumbnail img-fluid" src="https://employer.vietnamworks.com/bundles/naviworksuser/img/BANNER-03-1600X1000.png" alt=""></a>
        </div>
    </div>
</div>
@endsection
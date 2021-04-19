@extends("employer.master.layout")
@section("title","Xin chào {$employer->Fullname}")
@section("css")
    {{-- plugin drop image --}}
    <link rel="stylesheet" href="{{asset("employer/plugins/dropimage/css/main.css") }}">
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
@endsection

@section("js")
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="{{asset("employer/plugins/dropimage/js/main.js") }}"></script>
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
    
    $(".btn-upload").click(function(){
        $("#upload-file").trigger("click");
    })
	crop_image({
		id_preview: "preview_avatar",
		model_preview: "#modal-upload-avatar",
		btn_drop: "#crop_avatar",
		producted: ".box-thumbnail .thumbnail",
		preview_mini: "#modal-upload-avatar .preview_avatar_mini",
		input: "#upload-file",
        url_post:"{{ route('employer.upload') }}",
        _token:"{{ csrf_token() }}",
        ajax:true
	});
    </script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
    <div class="row">
        <div class="box-profile-employer col-md-8">
            <h2 class="title text-center">Thông tin chi tiết</h2>
            <nav class="box-top-controll">
                <ul class="box-option list-unstyled d-flex">
                    <li>
                        <a href="javascript:void(0)" class="active" id="label-info-employer">Nhà tuyển dụng</a>
                    </li>
                    <li>
                        <a href="{{ route("employer.company.info") }}" class="" id="label-info-company">Công ty</a>
                    </li>
                    <li>
                        <a href="{{ route("employer.history") }}" class="" id="label-history">Lịch sử hoạt động</a>
                    </li>
                </ul>
            </nav>
            <div class="box-info">
                <ul class="list-info list-unstyled ">
                    <li id="avatar" class="d-flex align-items-center justify-content-between flex-wrap">
                        @php
                            $url=asset("employer/img/avatars/default-{$employer->Gender}.jpg");
                            if($employer->Avatar){
                                $url=asset($employer->Avatar);
                            };
                        @endphp
                        <a href="javascript:void(0)" class="box-thumbnail">
                            <button class="btn-upload"><i class="fas fa-cloud-upload-alt"></i></button>
                            <input type="file" name="" class="d-none" id="upload-file">
                            <img class="thumbnail img-fluid" src="{{ $url }}" alt="">
                        </a>
                        <div class="box-option-other">
                            <button id="btn-model-update-profile" data-toggle="modal" data-target=".model-update-employer" class="btn btn-info">Cập nhật</button>
                            <button id="btn-model-repass" data-toggle="modal" data-target=".model-repass" class="btn btn-success">Đổi mật khẩu</button>
                        </div>
                    </li>
                    <li id="fullname">
                        <span class="label">Họ và tên:</span>
                        <span class="value">{{ $employer->Fullname }}</span>
                    </li>

                    <li id="age">
                        <span class="label">Giới tính:</span>
                        <span class="value">{{ __("user.Gender.{$employer->Gender}") }}</span>
                    </li>

                    <li id="phone">
                        <span class="label">Số điện thoại:</span>
                        <span class="value">{{ $employer->Phone ?? "Chưa cập nhật"}}</span>
                    </li>

                    <li id="service">
                        <span class="label">Chức vụ:</span>
                        <span class="value">@if($employer->Regency){{__("user.Regency.{$employer->Regency}") }} @else Chưa cập nhật @endif</span>
                    </li>

                    <li id="email">
                        <span class="label">Email:</span>
                        <span class="value">{{ $employer->User_Email ?? "Chưa cập nhật" }}</span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-md-4 align-self-center">
            <a href=""><img class="img-fluid" src="https://www.aviva.com.vn/Data/Sites/1/media/aviva-vietnam_photo.jpg" alt=""></a>
        </div>
    </div>

</div>


<!-- modal update profile employer -->

<div class="modal fade model-update-employer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h4 class="mb-0 text-center">Tác vụ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route("employer.update") }}" class="row" id="form-update-emplyer" method="post">
                    @csrf
                    <input type="hidden" name="continue" value="{{ route("employer.info")}}">
                    <h5 class="title pb-4 col-12">Thông tin nhà tuyển dụng</h5>
                    <div class="form-group col-md-12 @error("Fullname") form-error @enderror">
                        <label for="Fullname">Họ và tên: *</label> 
                        <input type="text" id="Fullname" class="form-control" name="Fullname" value="{{ old("Fullname") ?? $employer->Fullname }}">
                        @error("Fullname")
                            <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-12 @error("User_Email") form-error @enderror">
                        <label for="User_Email">Email: *</label>
                        <input type="text" id="User_Email" class="form-control" name="User_Email" value="{{ old("User_Email") ?? $employer->User_Email }}">
                        <small class="note font-italic">Jobber khuyến nghị đăng ký bằng email công ty (theo tên miền website công ty) để được hỗ trợ duyệt tin nhanh & đăng tin không giới hạn.</small>
                        @error("User_Email")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 @error("Phone") form-error @enderror">
                        <label for="Phone">Số điện thoại</label>
                        <input type="text" id="Phone" class="form-control" name="Phone" value="{{ old("Phone") ?? $employer->Phone }}">
                        @error("Phone")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- service -->
                    <div class="form-group col-md-4">
                        <label for="service">Chức vụ: </label>
                        <select type="text" name="Regency" class="form-control @error("Regency") form-error @enderror" id="Regency">
                            @foreach(__("user.Regency") as $key=>$item)
                            <option value="{{ $key }}" {{$employer->Regency == $key && $employer->Regency ? "selected" :"" }} >{{ $item }}</option>
                            @endforeach
                        </select>   
                        @error("Regency")
                        <small class="message">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- end service -->
                    <!-- gender -->
                    @php
                        $checked=["","",""];
                        $checked[$employer->Gender]="checked";
                    @endphp
                    <div class="form-group col-md-4">
                        <label for="">Giới tính: *</label>
                        <div class="custom-control custom-checkbox d-flex">
                            <div class="check-male pr-5">
                                <input type="radio" name="Gender" value="0" {{ $checked[0] }} class="custom-control-input" id="male">
                                <label class="custom-control-label" for="male">Nam</label>
                            </div>
                            <div class="check-female">
                                <input type="radio" name="Gender" value="1" {{ $checked[1] }} class="custom-control-input" id="female">
                                <label class="custom-control-label" for="female">Nữ</label>
                            </div>
                        </div>
                    </div>
                    <!-- end gender -->
                    <!-- submit -->
                    <div class="form-group col-12">
                        <button class="btn btn-outline-primary">Cập nhật</button>
                    </div>
                    <!-- endsubmit -->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end model -->
<!-- modal update password -->
<div class="modal fade model-repass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h4 class="mb-0 text-center">Tác vụ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route("employer.changePassword") }}" class="row" id="form-update-emplyer" method="post">
                    @csrf
                    <input type="hidden" name="continue" value="{{ route("employer.info") }}">
                    <h5 class="title pb-4 col-12">Đổi mật khẩu</h5>
                    <div class="form-group col-md-12 @error("User_Password_Old") form-error @enderror">
                        <label for="User_Password_Old">Mật khẩu cũ: </label>
                        <input type="password" name="User_Password_Old" id="User_Password_Old" class="form-control">
                        @error("User_Password_Old")
                            <span class="message">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group col-md-6 @error("User_Password_New") form-error @enderror">
                        <label for="User_Password_New">Mật khẩu mới: </label>
                        <input type="password" name="User_Password_New" id="User_Password_New" class="form-control">
                        @error("User_Password_Confirm")
                            <span class="message">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group col-md-6 @error("User_Password_Confirm") form-error @enderror">
                        <label for="User_Password_Confirm">Xác nhận mật khẩu: </label>
                        <input type="password" name="User_Password_Confirm" id="User_Password_Confirm" class="form-control">
                        @error('User_Password_Confirm')
                            <span class="message">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-outline-primary">Cập nhật</button>
                    </div>
                    <!-- endsubmit -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end model -->

<!-- modal upload avatar -->
<div class="modal fade" id="modal-upload-avatar" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="preview_avatar" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview_avatar_mini">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop_avatar" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection
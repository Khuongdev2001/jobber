@extends("candidate.master.index")
@section("title",$candidate->User_Email)
@section("css")
    {{-- plugin crop css --}}
    <link rel="stylesheet" href="{{ asset("candidate/plugin/dropimage/css/main.css") }}">
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("candidate/plugin/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("candidate/plugin/select2/css/select2-bootstrap4.css") }}">
@endsection
@section("js")

{{-- select 2 --}}
<script src="{{ asset("candidate/plugin/select2/js/select2.min.js") }}"></script>
{{-- plugin crop js --}}
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
<script src="https://unpkg.com/dropzone"></script>
<script src="https://unpkg.com/cropperjs"></script>
<script src="{{ asset("candidate/plugin/dropimage/js/main.js") }}"></script>
<script>
// crop avatar 
crop_image({
    id_preview: "preview_avatar",
    model_preview: "#model-upload-avatar",
    btn_drop: "#crop_avatar",
    producted: ".box-avatar img",
    preview_mini: ".preview_avatar_mini",
    input: "#upload-avatar",
    ajax:true,
    url_post:"{{ route('upload.image') }}",
    _token:"{{ csrf_token() }}"
});
// crop cover
crop_image({
    id_preview: "preview_cover",
    model_preview: "#model-upload-cover",
    btn_drop: "#crop_cover",
    producted: ".box-cover-imgage img",
    preview_mini: ".preview_cover_mini",
    input: "#upload-cover",
    ratio: 3.65,
    ajax:true,
    url_post:"{{ route('upload.image',['cover'=>1]) }}",
    _token:"{{ csrf_token() }}"
});

$("#btn-upload-cv").change(function(e) {
    $("#model-upload-cv .box-upload-cv #btn-preview-cv").remove();
    if (e.target.files[0].type.indexOf("application/pdf") != -1) {
        let url = URL.createObjectURL(e.target.files[0]);
        $("#model-upload-cv .box-upload-cv").append('<a href="' + url + '" id="btn-preview-cv" target="_black">Xem trước</a>');
    }
})

$(".list-cv .box-option .btn-delete-cv").click(function(e) {
    Swal.fire({
        title: 'Xóa CV',
        text: "Bạn có muốn xóa cv không!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Hoàn thành!',
                'Cv đã được xóa',
                'success'
            )
        }
    })
    return false;
})

$('#Specialize_ID').select2({
        // minimumInputLength: 2,
        tags: true,
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

    $('#Province_ID').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("employer.data.province") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {Province_Name: params.term};
            },
            processResults: function (data, params) {
                return {results: $.map(data, function (item) {return {text: item.Province_Name,id: item.Province_ID,data: item};})
                };
            }
        }
    });
</script>
@endsection
@section("content")
<div class="container pb-3 pt-1">
    <div class="row">
        <div class="box-left box-profile col-md-8">
            <div class="pannel pannel-top">
                <div class="box-profile-basic box-cover-imgage">
                    @php
                        $url= $candidate->Cover ?: "candidate/imgs/covers/cover-default.jpg"; 
                    @endphp
                    <a href="" id="cover-image"><img src="{{ asset($url) }}" alt="" class="thumbnail"></a>
                    <label for="upload-cover" href="" id="btn-upload-image-cover">Cập nhật ảnh bìa</label>
                    <input type="file" name="upload-cover" class="d-none" id="upload-cover">
                </div>
                <div class="box-profile-basic box-avatar">
                    @php
                        $url=$candidate->Avatar ?:"candidate/imgs/avatars/default.jpg";
                    @endphp
                    <div href="" id="avatar">
                        <label for="upload-avatar" id="btn-upload-avatar"><i class="fas fa-file-upload"></i></label>
                        <input type="file" name="upload-avatar" id="upload-avatar" class="d-none">
                        <img src="{{ asset($url) }}" alt="{{ $candidate->Fullname }}" id="thumbnail">
                    </div>
                </div>
                <div class="box-profile-basic box-info">
                    <span class="nickname">{{ $candidate->Fullname }}</span>
                    <span class="job">{{ $candidate->specialize->Name ?? "Chưa Cập Nhật" }}</span>
                </div>
                <div class="box-profile-basic box-option">
                    <button class="btn-convert-pdf">Tải Pdf</button>
                    <button class="btn-share">Chia sẽ</button>
                    <button class="btn-update-info" data-toggle="modal" data-target="#model-update-profile">Cập nhật</button>
                </div>
            </div>
            <div class="panel panel-body box-profile-details">
                <div id="gender" class="group">
                    <span class="label">Giới tính: </span>
                    <span class="info">@if($candidate->Gender!=null){{ __("user.Gender.{$candidate->Gender}") }}@else Chưa cập nhật @endif</span>
                </div>
                <div id="phone" class="group">
                    <span class="label">Số điện thoại: </span>
                    <span class="info">{{ $candidate->Phone ?? "Chưa Cập Nhật" }}</span>
                </div>
                <div id="email" class="group">
                    <span class="label">Email liên hệ: </span>
                    <span class="info">{{ $candidate->User_Email ?? "Chưa Cập Nhật" }}</span>
                </div>
                <div id="address" class="group">
                    <span class="label">Địa chỉ: </span>
                    <span class="info">{{ $candidate->Address ?? "Chưa Cập Nhật" }}</span>
                </div>
                <div id="birthday" class="group">
                    <span class="label">Ngày sinh: </span>
                    <span class="info">{{ $candidate->Birthday ?? "Chưa Cập Nhật" }}</span>
                </div>
                <div id="marriage" class="group">
                    <span class="label">Hôn nhân: </span>
                    <span class="info">@if($candidate->Marriage!==null) {{ __("user.Marriage.{$candidate->Marriage}") }} @else Chưa Cập Nhật @endif</span>
                </div>
                <div id="special" class="group">
                    <span class="label">Ngành: </span>
                    <span class="info">{{ $candidate->specialize->Name ?? "Chưa cập nhật" }}</span>
                </div>
                <div id="experience" class="group">
                    <span class="label">Kinh nghiệm: </span>
                    <span class="info">@if($candidate->Experience) {{ __("user.Experience.{$candidate->Experience}") }} @else Chưa Cập Nhật @endif </span>
                </div>
                <div id="wage" class="group">
                    <span class="label">Mức lương: </span>
                    <span class="info">
                        @php
                            $wage="Mức lương thỏa thuận";
                            if($candidate->Wage_From || $candidate->Wage_To ){
                                $wage=$candidate->Wage_To ? "Mức lương đến: ".currency($candidate->Wage_To) :"Mức lương từ: ".currency($candidate->Wage_From); 
                            }
                            if($candidate->Wage_From && $candidate->Wage_To ){
                                $wage="Mức lương từ: ".currency($candidate->Wage_From)." Đến ".currency($candidate->Wage_To);
                            }
                        @endphp
                        {{ $wage }}
                    </span>
                </div>
            </div>
            <div class="box-profile-details">
                <div id="desc" class="group">
                    <span class="label">Mô tả:</span>
                    <span class="info">{{ $candidate->Description ?? "Chưa cập nhật" }}</span>
                </div>
            </div>
            <div class="box-list-cv">
                <div class="box-top">
                    <h4 class="title">Quản lý cv</h4>
                    <a class="btn-add-cv" data-toggle="modal" data-target="#model-upload-cv" href="">Thêm</a>
                </div>
                <ul class="list-cv">
                    @foreach($candidate->cvs as $cv)
                    <li>
                        <div class="box-cv">
                            <iframe src="{{ asset($cv->File) }}" width="100%" height="100%" frameborder="0"></iframe>
                        </div>
                        <div class="box-option">
                            <h5 class="title">{{ $cv->Cv_Title }}</h5>
                            <p class="date-created">{{ $cv->Cv_Created_At }}</p>
                            <a href="{{ route("action.cv",["id"=>$cv->Cv_ID,"option"=>$cv->Is_Default ]) }}" class="btn-set-cv-default @if($cv->Is_Default) active @endif">Đặt làm cv mặt định</a>
                            <a href="{{ asset($cv->File) }}" download="Jobber_Cv_{{ $cv->File }}" class="btn-download-cv">Tải cv xuống</a>
                            <a href="{{ asset($cv->File) }}" class="btn-seen-cv">Xem cv</a>
                            <a href="{{ route("action.cv",["id"=>$cv->Cv_ID,"option"=>2]) }}" class="btn-delete-cv">Xóa Cv</a>
                        </div>
                    </li>      
                    @endforeach              
                </ul>
            </div>
        </div>
        <div class="box-right box-profile box-status col-md-4">
            <div class="pannel">
                <div class="form-group m-0">
                    <input type="checkbox" id="status" name="status">
                    <label for="status"> Ẩn thông tin profile </label>
                </div>
                <p class="desc">
                    Khi tắt ngày tuyền dụng sẽ không thể xem thông tin profile của bạn
                </p>
            </div>
            <div class="pannel">
                <div class="form-group m-0">
                    <input type="checkbox" id="status" name="status">
                    <label for="status"> Thông báo việc làm </label>
                </div>
                <p class="desc">
                    Bật lên để nhận thông báo công việc phù hợp
                </p>
            </div>
            <div class="pannel statical">
                <span class="title">Ai đó xem thông tin của bạn</span>
                <ul class="list-people-seen">
                @if(count($employerSeens))    
                    @foreach($employerSeens as $employerSeen)
                    <li>
                        <a href="{{ route("company.info",$employerSeen->Company_Slug) }}" class="employer"><img class="thumbnail" src="{{ asset($employerSeen->Company_Logo) }}" alt="{{ $employerSeen->Company_Name }}"></a>
                    </li>
                    @endforeach
                @else               
                    <li>Không có nhà tuyển dụng nào xem bạn</li>
                @endif    
                </ul>
            </div>
            <div class="pannel banner-advertisement p-0">
                <a href="" class="banner">
                    <img src="https://fptshop.com.vn/uploads/images/tin-tuc/77581/Originals/IMG_9876.JPG" class="thumbnail" alt="">
                </a>
            </div>
        </div>

    </div>
</div>

<!-- model-update-profile -->
<div class="modal fade" id="model-update-profile" role="dialog" aria-labelledby="model-update-profile" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route("info") }}" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật thông tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                @csrf
                <input type="hidden" name="continue" value="{{ route("info") }}">
                <div class="form-group col-md-4 @error("Fullname") form-error @enderror">
                    <label for="Fullname">Họ và tên: </label>
                    <input type="text" name="Fullname" id="Fullname" class="form-control" value="{{ $candidate->Fullname }}">
                    @error("Fullname")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 @error("Specialize_ID") form-error @enderror">
                    <label for="Specialize_ID">Công việc hiện tại: </label>
                    <select name="Specialize_ID" id="Specialize_ID" class="form-control">
                        <option value="{{ $candidate->Specialize_ID }}">{{ $candidate->specialize->Name ??"" }}</option>
                    </select>
                    @error("Specialize_ID")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 @error("Gender") form-error @enderror">
                    <label for="Gender">Giới tính: </label>
                    <select name="Gender" class="form-control basic-select" id="Gender">
                       @foreach(__("user.Gender") as $key => $item)
                        <option value="{{ $key }}" @if($candidate->Gender == $key) selected @endif>{{ $item }}</option>
                       @endforeach
                    </select>
                    @error("Gender")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 @error("Phone") form-error @enderror">
                    <label for="Phone">Số điện thoại: </label>
                    <input type="text" name="Phone" id="Phone" class="form-control" value="{{ old("Phone") ?? $candidate->Phone }}">
                    @error("Phone")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4 @error("User_Email") form-error @enderror">
                    <label for="User_Email">Email: </label>
                    <input type="text" name="User_Email" id="User_Email" class="form-control" value="{{ old("User_Email") ?? $candidate->User_Email }}">
                    @error("User_Email")
                        <span class="message">{{ $message }}</span>                    
                    @enderror
                </div>
                <div class="form-group col-md-4 @error("Marriage") form-error @enderror">
                    <label for="Marriage">Hôn nhân: </label>
                    <select name="Marriage" class="form-control" id="Marriage">
                       @foreach(__("user.Marriage") as $key => $item)
                            <option value="{{ $key }}" @if($candidate->Marriage == $key) selected @endif>{{ $item }}</option>
                       @endforeach
                    </select>
                    @error("Marriage")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="Birthday">Ngày sinh: </label>
                    <input type="date" name="Birthday" id="Birthday" value="{{ old("Birthday") ?? $candidate->Birthday }}" class="form-control">
                </div>
                <div class="form-group col-md-4">
                    <label for="Province_ID">Khu vực thông báo: </label>
                    <select name="Province_ID" class="form-control" id="Province_ID">
                        <option value="{{ $candidate->Province_ID }}">{{ $candidate->province->Province_Name ?? "" }}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="Experience">Kinh nghiệm: </label>
                    <select name="Experience" class="form-control basic-select" id="Experience">
                        @foreach( __("user.Experience") as $key=>$item)
                            <option value="{{ $key }}" @if($candidate->Experience==$key) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 @error("Wage_From") form-error @enderror">
                    <label for="Wage_From">Mức lương từ: </label>
                    <input type="text" class="form-control" id="Wage_From" name="Wage_From" value="{{ old("Wage_From") ?? $candidate->Wage_From }}">
                    @error("Wage_From")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="form-group col-md-4 @error("Wage_To") form-error @enderror">
                    <label for="Wage_To">Mức lương đến: </label>
                    <input type="text" class="form-control" name="Wage_To" id="Wage_To" value="{{ old("Wage_To") ?? $candidate->Wage_To }}">
                    @error("Wage_To")
                        <span class="message">{{ $message }}</span>
                    @enderror
                 </div>
                <div class="form-group col-md-12">
                    <label for="Address">Địa chỉ: </label>
                    <textarea type="text" name="Address" id="Address" cols="10" rows="5" class="form-control">{{ $candidate->Address }}</textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="Description">Mô tả: </label>
                    <textarea type="text" name="Description" id="Description" cols="10" rows="5" class="form-control">{{ $candidate->Description }}</textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- model upload avatar -->
<div class="modal fade" id="model-upload-avatar" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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

<!-- model upload cover -->
<div class="modal fade" id="model-upload-cover" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                            <img src="" id="preview_cover" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview_cover_mini">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop_cover" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>

<!-- model upload cv -->
<div class="modal fade" id="model-upload-cv" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route("upload.cv") }}" class="modal-content" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Upload Cv của bạn</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <input type="hidden" name="continue" value="{{ route("info") }}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="cv-title">Tiêu đề cv</label>
                    <input type="text" class="form-control" name="Cv_Title" id="cv-title">
                </div>
                <div class="form-group box-upload-cv">
                    <label for="btn-upload-cv">Tải cv(pdf): </label>
                    <input type="file" name="cv" class="d-none" id="btn-upload-cv">
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-upload-cv" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends("employer.master.layout")
@section("title","Xin chào công ty {$employer->Company_Name}")
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
            }}
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
    
    $(".btn-upload-logo").click(function(){
        $("#upload-file-logo").trigger("click");
    })
    $(".btn-upload-cover").click(function(){
        $("#upload-file-cover").trigger("click");
    })
	crop_image({
		id_preview: "preview_logo",
		model_preview: "#modal-upload-logo",
		btn_drop: "#crop_logo",
		producted: ".box-preview-logo .box-thumbnail .thumbnail",
		preview_mini: "#modal-upload-logo .preview_logo_mini",
		input: "#upload-file-logo",
        hidden_file:".box-preview-logo .hidden-file"
	});

    crop_image({
		id_preview: "preview_cover",
		model_preview: "#modal-upload-cover",
		btn_drop: "#crop_cover",
		producted: ".box-preview-cover .box-thumbnail .thumbnail",
		preview_mini: "#modal-upload-cover .preview_cover_mini",
		input: "#upload-file-cover",
        hidden_file:".box-preview-cover .hidden-file",
        ratio:2.1
	});
    </script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
    <div class="row">
        <div class="box-profile-company col-md-8">
            <h2 class="title text-center">Thông tin chi tiết</h2>
            <nav class="box-top-controll">
                <ul class="box-option list-unstyled d-flex">
                    <li>
                        <a href="{{ route("employer.info") }}" class="" id="label-info-employer">Nhà tuyển dụng</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="active" id="label-info-company">Công ty</a>
                    </li>
                    <li>
                        <a href="{{ route("employer.history") }}" class="" id="label-history">Lịch sử hoạt động</a>
                    </li>
                </ul>
            </nav>
            <div class="box-info">
                <ul class="list-info list-unstyled">
                    <form action="{{ route("employer.company.update") }}" method="post" class="row">
                        @csrf
                        <!-- company name -->
                        <div class="form-group @error("Company_Name") form-error @enderror col-md-6">
                            <label for="Company_Name">Tên công ty: </label>
                            <input type="text" id="Company_Name" name="Company_Name" class="form-control" value="{{ old("Company_Name") ?? $employer->Company_Name }}">
                            @error("Company_Name")
                              <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company name -->

                        <!-- company phone -->
                        <div class="form-group col-md-6 @error("Company_Phone") form-error @enderror">
                            <label for="Company_Phone">Số điện thoại công ty: </label>
                            <input type="text" id="Company_Phone" name="Company_Phone" class="form-control" value="{{ old("Company_Phone") ?? $employer->Company_Phone }}">
                            @error("Company_Phone")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company phone -->

                        <!-- company address -->
                        <div class="form-group col-md-6 @error("Company_Address") form-error @enderror">
                            <label for="Company_Address">Địa chỉ công ty: </label>
                            <input type="text" id="Company_Address" name="Company_Address" class="form-control" value="{{ old("Company_Address") ?? $employer->Company_Address }}">
                            @error("Company_Address")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company phone -->

                        <!-- company size -->
                        <div class="form-group col-md-6 @error("Company_Size") form-error @enderror ">
                            <label for="Company_Size">Quy mô công ty: </label>
                            <select name="Company_Size" id="Company_Size" class="form-control">
                               @foreach(__("user.Company_Size") as $key=>$item)
                                  <option value="{{ $key }}" @if($employer->Company_Size && $employer->Company_Size == $key ) selected  @endif>{{ $item }}</option>
                               @endforeach
                            </select>
                            @error("Company_Size")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company size -->

                        <!-- company speciality -->
                        <div class="form-group col-md-6 @error("Specialize_ID") form-error @enderror">
                            <label for="Specialize_ID">Nghành nghề kinh doanh: </label>
                            <select type="text" id="Specialize_ID" name="Specialize_ID" class="form-control">
                                <option value="{{ $employer->specialize->Specialize_ID }}">{{ $employer->specialize->Name }}</option>
                            </select>
                            @error("Specialize_ID")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company speciality -->

                        <!-- company province -->
                        <div class="form-group col-md-6 @error("Province_ID") form-error @enderror">
                            <label for="Province_ID">Tỉnh thành: </label>
                            <select type="text" id="Province_ID" name="Province_ID" class="form-control">
                                <option value="{{ $employer->province->Province_ID ?? "" }}">{{ $employer->province->Province_Name ?? "" }}</option>
                            </select>
                            @error("Province_ID")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company province -->

                        <!-- company contactor -->
                        <div class="form-group col-md-6 @error("Company_Contactor") form-error @enderror">
                            <label for="Company_Contactor">Người liên hệ: </label>
                            <input type="text" id="Company_Contactor" name="Company_Contactor" class="form-control" value="{{ old("Company_Contactor") ?? $employer->Company_Contactor  }}">
                            @error("Company_Contactor")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company contactor -->

                        <!-- company email -->
                        <div class="form-group col-md-6 @error("Company_Email") form-error @enderror">
                            <label for="Company_Email">Email công ty: </label>
                            <input type="text" id="Company_Email" name="Company_Email" class="form-control" value="{{  old("Company_Email") ?? $employer->Company_Email  }}">
                            @error("Company_Email")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company email -->

                        <!-- company website -->
                        <div class="form-group col-md-6 @error("Company_Website") form-error @enderror">
                            <label for="Company_Website">Website công ty: </label>
                            <input type="text" id="Company_Website" name="Company_Website" class="form-control" value="{{ old("Company_Website") ?? $employer->Company_Website  }}">
                            @error("Company_Website")
                                <span class="message">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- end company websit -->

                        <!-- company desc -->
                        <div class="form-group col-md-12">
                            <label for="Company_Description">Mô tả công ty: </label>
                            <textarea name="Company_Description" id="Company_Description" class="form-control" cols="30" rows="6">{{ old("Company_Description") ?? $employer->Company_Description }}</textarea>
                            @error("Company_Website")
                            <span class="message">{{ $message }}</span>
                        @enderror
                        </div>
                        <!-- end company desc -->

                        <!-- company-avatar -->
                        <div class="form-group col-12">
                            <label for="company-logo">Logo công ty:<small>(Sẽ hiện thị mỗi bài đăng)</small></label>
                            <div class="box-preview-logo text-center">
                                <a href="javascript:void(0)" class="box-thumbnail">
                                    @php
                                        $url="";
                                        if($employer->Company_Logo){
                                            $url=asset($employer->Company_Logo);
                                        }
                                    @endphp
                                    <img class="thumbnail img-fluid" src="{{ $url }}">
                                </a>
                                <input type="file" name="company-logo" id="upload-file-logo" class="d-none">
                                <input type="hidden" class="hidden-file" name="Company_Logo">
                                <a href="javascript:void(0)" class="btn btn-upload btn-upload-logo"><i class="fas fa-cloud-upload-alt"></i></a>
                            </div>
                        </div>
                        <!-- end company-logo  -->

                        <!-- company-cover -->
                        <div class="form-group col-12">
                            <label for="company-cover">Banner công ty:</label>
                            <div class="box-preview-cover">
                                <a href="javascript:void(0)" class="box-thumbnail">
                                    @php
                                        $url="";
                                        if($employer->Company_Cover){
                                            $url=asset($employer->Company_Cover);
                                        }
                                    @endphp
                                    <img class="thumbnail img-fluid" src="{{ $url }}">
                                </a>
                                <input type="file" name="company-cover" id="upload-file-cover" class="d-none">
                                <a href="javascript:void(0)" class="btn btn-upload btn-upload-cover"><i class="fas fa-cloud-upload-alt"></i></a>
                                <input type="hidden" class="hidden-file" name="Company_Cover">
                            </div>
                        </div>
                        <!-- end company-cover -->
                        <!-- btn -->
                        <div class="form-group col-12">
                            <button class="btn btn-outline-success float-right">Cập nhật</button>
                        </div>
                        <!-- end btn -->
                    </form>
                </ul>
            </div>
        </div>
        <div class="col-md-4 pt-5">
            <a href=""><img class="img-fluid" src="https://www.aviva.com.vn/Data/Sites/1/media/aviva-vietnam_photo.jpg" alt=""></a>
        </div>
    </div>
</div>

<!-- modal upload logo -->
<div class="modal fade" id="modal-upload-logo" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="preview_logo" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview_logo_mini"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop_logo" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- modal upload cover -->
<div class="modal fade" id="modal-upload-cover" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa logo</h5>
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
                            <div class="preview_cover_mini"></div>
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
<!-- end modal -->
@endsection
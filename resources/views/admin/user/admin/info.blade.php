@extends("admin.master.layout")
@section('title', $user->Fullname)
@section('css')
    {{-- require css more --}}
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
    {{-- cropper image --}}
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("admin/plugins/dropimage/css/main.css") }} ">
@endsection

@section('js')
    {{-- require js more --}}
    {{-- select 2 --}}
    <script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
    {{-- js cropper --}}
    <!-- plugin upload image avatar -->
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="{{ asset("admin/plugins/dropimage/js/main.js") }}"></script>
    <script>
        $('.single-select').select2({
		theme: 'bootstrap4',
		width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
		placeholder: $(this).data('placeholder'),
		allowClear: Boolean($(this).data('allow-clear')),
	});

    $(".profile-admin .btn-upload-file").click(function() {
		$(".profile-admin #upload-file").trigger("click");
		return false;
	})
	// crop avatar 
	crop_image({
		id_preview: "preview_avatar",
		model_preview: "#modal-upload-avatar",
		btn_drop: "#crop_avatar",
		producted: ".profile-admin .thumbnail",
		preview_mini: "#modal-upload-avatar .preview_avatar_mini",
		input: ".profile-admin #upload-file",
        url_post:"{{ route('admin.user.admin.upload.image',['id'=>$user->User_ID]) }}",
        _token:"{{ csrf_token() }}",
        ajax:true
	});
    </script>
@endsection()

@section('sidebar')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profilep</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <!-- upload profile -->
                                    <div class="col-md-12 profile-admin position-relative">
                                        <a href="javascript:void(0)" class="btn-upload-file btn btn-success"><i class="fas fa-file-upload"></i></a>
                                        <input type="file" class="d-none" id="upload-file">
                                        @php
                                            $url=empty($user->Avatar) ? "admin/images/avatars/default.jpg" : $user->Avatar;
                                        @endphp
                                        <a href="" class="box-thumbnail overflow-hidden"><img src="{{ asset($url) }}" class="thumbnail img-fluid" alt=""></a>
                                    </div>
                                    <!-- end upload profile -->
                                    <div class="mt-3">
                                        <h4>{{ $user->Fullname }}</h4>
                                        <button class="btn btn-light">Admin</button>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                            </svg>Website</h6>
                                        <span class="text-white">https://codervent.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline">
                                                <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                            </svg>Github</h6>
                                        <span class="text-white">codervent</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline">
                                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                            </svg>Twitter</h6>
                                        <span class="text-white">@codervent</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline">
                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                            </svg>Instagram</h6>
                                        <span class="text-white">codervent</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline">
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                            </svg>Facebook</h6>
                                        <span class="text-white">codervent</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form class="row g-3 needs-validation" method="POST" action="{{ route("admin.user.admin.update",["id"=>$user->User_ID])}}" novalidate>
                                    @csrf
                                    <!-- fullname  -->
                                    <div class="col-md-6">
                                        <label for="fullname" class="form-label">Họ và tên: </label>
                                        <input type="text" class="form-control @error("Fullname") form-error" @enderror id="fullname" name="Fullname" value="{{ old("Fullname") ?? $user->Fullname }}" required>
                                        @error("Fullname")
                                            <div class="invalid-message">{{ $message }}</div>                                       
                                        @enderror
                                    </div>
                                    <!-- end fullname -->
                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email: </label>
                                        <input type="text" class="form-control @error("User_Email") form-error @enderror" id="email" name="User_Email" value="{{ $user->User_Email }}" required>
                                        @error("User_Email")
                                            <div class="invalid-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- end email -->
                                    <!-- password -->
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Mật khẩu: </label>
                                        <input type="password" class="form-control @error("User_Password") form-error @enderror" id="password" name="User_Password" value="" aria-describedby="inputGroupPrepend" required>
                                        @error("User_Password")
                                            <div class="invalid-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- end password -->
                                    <!-- role -->
                                    <div class="col-md-6">
                                        <label class="form-label">Quyền: </label>
                                        <select name="Level" class="single-select" data-placeholder="Choose anything">
                                            <option value=""></option>
                                            @php
                                                $level=[5=>'',4=>'',6=>''];
                                                $level[$user->Level]="selected";
                                            @endphp
                                            <option value="6" {{ $level[6] }}>Quản trị hệ thống</option>
                                            <option value="5" {{ $level[5] }}>Cấp cao</option>
                                            <option value="4" {{ $level[4] }}>Cấp thấp</option>
                                        </select>
                                    </div>
                                    <!-- end role -->
                                    <div class="col-12">
                                        <button class="btn btn-light float-right" type="submit">Cập nhật</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal upload file -->
<div class="modal fade" id="modal-upload-avatar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="crop_avatar">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')@endsection

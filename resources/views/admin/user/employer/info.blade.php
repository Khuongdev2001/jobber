
@extends("admin.master.layout")
@section('title', $user->Fullname)
@section('css')
    {{-- require css more --}}
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/dropimage/css/main.css") }} ">
@endsection

@section('js')
    {{-- require js more --}}
    {{-- select 2 --}}
    <script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
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
            <div class="breadcrumb-title pe-3">User</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết nhà tuyển dụng</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-light">Settings</button>
                    <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
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
                                    @php
                                        $url=$user->Avatar ? asset($user->Avatar) : asset("admin/images/avatars/default-".$user->Gender.".jpg");
                                    @endphp
                                    <a href="" class="box-thumbnail overflow-hidden"><img src="{{ $url }}" class="thumbnail img-fluid" alt=""></a>
                                    <div class="mt-3">
                                        <!-- fullname -->
                                        <h4>{{ $user->Fullname }}</h4>
                                        <!-- end fullname -->

                                        <!-- company-name -->
                                        <p class="mb-1">{{ $user->Company_Name }}</p>
                                        <!-- end company-name -->
                                        <button class="btn btn-light">{{ $user->Company_Name }}</button>
                                        <button class="btn btn-light">Message</button>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fab fa-pagelines mx-2"></i>Tuổi: </h6>
                                        <span class="text-white">18 chưa có trường</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="far fa-smile-beam mx-2"></i></i>Chức vụ: </h6>
                                        <span class="text-white">{{ __("user.Regency.{$user->Regency}") }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-mobile-alt mx-2"></i>Số điện thoại:</h6>
                                        <span class="text-white">{{ $user->Phone }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-envelope-square mx-2"></i></i>Email:</h6>
                                        <span class="text-white">{{ $user->User_Email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <h4 class="title p-3">Thông tin chung công ty</h4>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên công ty: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Name }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email công ty : </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Email }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Điện thoại: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Phone }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Địa chỉ: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Address }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Quy mô: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ __("user.Company_Size.{$user->Company_Size}") }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nghành nghề: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->specialize->Name }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Người liên hệ: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Contactor }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Website: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Company_Website }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3 box-avatar-company">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh nền công ty: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        @if($user->Company_Company_Logo)
                                            <a href="" class="box-thumbnail d-block text-center"><img src="" class="thumbnail" alt=""></a>
                                        @else
                                            <strong class="text-danger">Công ty chưa upload ảnh</strong>
                                        @endif    
                                    </div>
                                </div>
                                <div class="row mb-3 box-banner-company">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Banner công ty: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        @if($user->Company_Cover)
                                            <a href="" class="box-thumbnail d-block text-center"><img src="" class="thumbnail" alt=""></a>
                                        @else
                                            <strong class="text-danger">Công ty chưa upload ảnh</strong>
                                        @endif   
                                    </div>
                                </div>
                                <div class="row mb-3 box-banner-company">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Giấy phép kinh doanh: </h6>
                                    </div>
                                    <div class="col-sm-8">
                                        @if(!$user->Company_Is_Confirm)
                                            <input type="button" class="btn-hero btn-info-hero me-2" value="Xem giấy phép" />
                                            <a href="" class="btn-hero btn-success-hero" value="Duyệt"></a>
                                        @else
                                            <input type="button" class="btn-hero btn-success-hero" value="Đã duyệt" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')@endsection

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
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết ứng viên</li>
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

                                        <!-- speciality -->
                                        <p class="mb-1">{{ $user->specialize->Name }}</p>
                                        <!-- end speciality -->

                                        <!-- address -->
                                        <p class="font-size-sm">{{ $user->Address }}</p>
                                        <!-- end address -->
                                        <button class="btn btn-light">Ứng viên</button>
                                        <button class="btn btn-light">Message</button>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-birthday-cake mx-2"></i>Ngày sinh:</h6>
                                        <span class="text-white">{{ $user->Birthday }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-genderless mx-2"></i>Giới tính: </h6>
                                        <span class="text-white">{{ __("user.Gender.{$user->Gender}") }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-ring mx-2"></i>Hôn nhân:</h6>
                                        <span class="text-white">{{ __("user.Marriage.{$user->Marriage}") }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fab fa-expeditedssl mx-2"></i>Kinh nghiệm:</h6>
                                        <span class="text-white">{{ __("user.Experience.{$user->Experience}") }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><i class="fas fa-money-bill mx-2"></i>Mức lương:</h6>
                                        @php
                                            $message="Mức lương thỏa thuận";
                                            if($user->Wage_To || $user->Wage_From){
                                                $message="Mức lương dưới ". $user->Wage_To ? number_format($user->Wage_To)." VNĐ" : $user->Wage_From." VNĐ";
                                            }
                                            if($user->Wage_To && $user->Wage_From){
                                                $message="Mức lương từ ".number_format($user->Wage_From)." VNĐ đến ".number_format($user->Wage_To)." VNĐ";
                                            }
                                        @endphp
                                        <span class="text-white">{{ $message }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Họ và tên: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Fullname }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->User_Email }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Điện thoại: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Phone }}" readonly/>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Địa chỉ: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user->Address }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mô tả: </h6>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea name="" class="form-control" id="" cols="30" rows="5">{{ $user->Description }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <input type="button" class="btn btn-light px-4" value="Xem ảnh bìa" />
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

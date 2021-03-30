@extends("admin.master.layout")
@section('title', 'Thêm admin')
@section('css')
    {{-- require css more --}}
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
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
    </script>
@endsection()

@section('sidebar')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')
    <!--start page wrapper -->
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
        <form action="{{ route("admin.user.admin.add") }}" method="POST" class="container">
            @csrf
            <div class="main-body">
                <h5 class="py-2">Thêm Admin mới</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3 needs-validation" novalidate>
                            {{-- fullname --}}
                            <div class="col-md-6">
                                <label for="fullname" class="form-label">Họ và tên: </label>
                                <input type="text" class="form-control @error("Fullname") form-error @enderror " id="fullname" name="Fullname" value="{{ old("Fullname") }}" required>
                                @error("Fullname")
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- end fullname --}}
                            
                            {{-- email --}}
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email: </label>
                                <input type="text" class="form-control @error("User_Email") form-error @enderror" id="email" name="User_Email" value="{{ old("User_Email") }}" >
                                @error("User_Email")
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- end email --}}
                            
                            {{-- password --}}
                            <div class="col-md-6">
                                <label for="password" class="form-label">Mật khẩu: </label>
                                <input type="password" class="form-control @error("User_Password") form-error @enderror" id="password" name="User_Password" value="{{ old("User_Password") }}" aria-describedby="inputGroupPrepend" required>
                                @error("User_Password")
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                           {{-- end password --}}

                           {{-- role --}}
                            <div class="col-md-6">
                                <label class="form-label">Quyền: </label>
                                <select name="Level" class="single-select" data-placeholder="Choose anything">
                                    <option value="">Chọn quyền</option>
                                    <option value="4">Cấp Cao</option>
                                    <option value="5">Cấp Thấp</option>
                                </select>
                                @error("Level")
                                    <div class="invalid-message">{{ $message }}</div>
                                @enderror
                            </div>
                           {{-- end role --}}
                            <div class="col-12">
                                <button class="btn btn-light float-right" type="submit">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
<!-- end modal -->
@endsection

@section('footer')@endsection

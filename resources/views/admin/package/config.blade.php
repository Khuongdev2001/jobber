@extends("admin.master.layout")
@section('title', 'Danh sách nhà tuyển dụng')
@section('css')
    {{-- require css more --}}
   @endsection

@section('js')
    {{-- require js more --}}
   
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
                <div class="breadcrumb-title pe-3">Cấu hình</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cập nhật giá gói cước</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="container">
                <div class="main-body" style="min-height: 500px;">
                    <form action="{{ route("admin.package.post.update") }}" method="post" class="py-3 form-update-package bg-white text-dark p-2">
                        <h6 class="title text-dark">Gói đăng tin</h6>
                        <div class="row">
                            @csrf
                            <input type="hidden" name="continue" value="{{ route("admin.package.config") }}">
                            @foreach($postPackages as $package)
                            <div class="form-group col-md-4 my-2">
                                <label for="">{{ $package->Package_Name }}</label>
                                <input type="hidden" name="Package_ID[]" value="{{ $package->Package_ID }}">
                                <input type="text" class="form-control" name="Package_Value[{{ $package->Package_ID }}]" value="{{ $package->Package_Price }}">
                            </div>
                            @endforeach
                            <div class="col-12">
                                <button class="btn-hero btn-success-hero">Cập nhật</button>
                            </div>
                        </div>
                    </form>
   
                    <form action="{{ route("admin.package.fitlter.update") }}" method="POST" class="py-3 form-update-package">
                        <h6 class="title">Gói lọc hồ sơ: </h6>
                        @csrf
                        <input type="hidden" name="continue" value="{{ route("admin.package.config") }}">
                        <div class="row" style="align-items: flex-end" >
                            <div class="form-group col-md-4">
                                <label for="">Số tiền: </label>
                                <div class="d-flex">
                                    <input type="text" name="Package_Price" class="form-control" value="{{ $fitlerPackage->Package_Price }}" id="">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Số điểm: </label>
                                <div class="d-flex">
                                    <input type="text" name="Package_Value" class="form-control" value="{{ $fitlerPackage->Package_Value }}" id="">
                                </div>
                            </div>
                            <div class="col-4">
                                <button class="btn-hero btn-success-hero">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--end page wrapper -->

<div id="add-cat" class="modal-more">
    <div class="modal-notification modal-lg text-dark">
        <button class="btn-exit btn"><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="dialog"></div>
</div>

@endsection

@section('footer')@endsection

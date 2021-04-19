@extends("employer.master.layout")
@section("title","Trang Tổng Quan")
@section("css")
@endsection

@section("js")
<script src="{{ asset("employer/plugins/jquery-appear/jquery.appear.js") }}"></script>
<script src="{{asset("employer/plugins/jquery-count-to/jquery.countTo.js")}}"></script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
    <div class="section-title center pt-5 pb-3">
        <h2 class="title">Số liệu thống kê của của bạn</h2>
    </div>
    <div class="box-static post">
        <div class="post-job">
            <ul class="row list-unstyled">
                <!-- posted -->
                <li class="col-md-3">
                    <div class="posted">
                        <h6 class="title">Bài hiển thị</h6>
                        <span class="number counter" data-number="10">0</span>
                        <a href="" class="see-more">Xem thêm</a>
                    </div>
                </li>
                <!-- end post -->
                <!-- post save -->
                <li class="col-md-3">
                    <div class="post-save">
                        <h6 class="title">Bài đã lưu</h6>
                        <span class="number counter" data-number="20">
                            0
                        </span>
                        <a href="" class="see-more">Xem thêm</a>
                    </div>
                </li>
                <!-- end post -->
                <!-- post-limit -->
                <li class="col-md-3">
                    <div class="post-limit">
                        <h6 class="title">Bài hết hạng </h6>
                        <span class="counter number" data-number="40">
                            0
                        </span>
                        <a href="" class="see-more">Xem thêm</a>
                    </div>
                </li>
                <!-- end post -->
                <li class="col-md-3">
                    <!-- fillter package -->
                    <div class="fillter-package">
                        <h6 class="title">Số điểm lọc hồ sơ</h6>
                        <span class="number counter" data-number="40">
                            0
                        </span>
                        <a href="" class="buy-more">Mua thêm</a>
                    </div>
                    <!-- end fillter package -->
                </li>
            </ul>
        </div>
        <div class="package">
            <!-- post job package  -->
            <div class="post-job py-4">
                <h3 class="title">Gói dịch vụ</h3>
                <ul class="row list-unstyled">
                    @foreach($services as $service)
                    <li class="col-md-3">
                        <div class="package-basic">
                            <h6 class="title">{{ __("package.{$service->Package_ID}.Package_Name") }}</h6>
                            <span class="number counter" data-number="{{ $service->Total }}">
                               {{ $service->Total }}                              
                            </span>                        
                            
                            <a href="{{ route("employer.product.buy") }}" class="">Mua thêm</a>
                        </div>
                    </li>  
                    @endforeach                  
                </ul>
            </div>            
        </div>
    </div>

</div>
@endsection
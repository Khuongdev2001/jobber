@extends("employer.master.layout")
@section("title","Mua gói cước")


@section("js")
    <script>
      $(".box-product .btn-arrow").click(function() {
        $(this).toggleClass("active");
        $(this).parents(".product").find(".list-package").toggleClass("show");
    })
    // active buy product
    $(document).on("click", ".box-product .btn-buy:not(.btn-trash)", function() {
        $(this).addClass("btn-trash");
        $(this).html('<i class="fas fa-trash-alt"></i>');
        $(this).parents(".list-package .row").find(".qty").addClass("show");  
        $(".box-product.box-total").addClass("show");
        ajaxAddProduct({qty:1,id:$(this).parents(".row").find(".qty").attr("data-id")});      
        addLoading();
    })
    $(document).on("click", ".box-product .btn-buy.btn-trash", function() {
        $(this).removeClass("btn-trash");
        $(this).html('Mua thêm');
        ajaxAddProduct({qty:0,id:$(this).parents(".row").find(".qty").attr("data-id")}); 
        addLoading();   
        $(this).parents(".list-package .row").find(".qty").removeClass("show");
    })
    function ajaxAddProduct({qty,id}){
        $.post("{{route('employer.product.addProduct')}}",{qty:qty,id:id,_token:$("[name='csrf-token']").attr("content")},function(data){            
            $(".box-product .total").text(data.total);
            if(!data.totalRaw){
                $(".box-product.box-total").removeClass("show");
            }
            $(`#qty-${data.id}`).val(data.qty);
            removeLoading();
            if(!Number(data.qty)){
               return $(`#qty-${data.id}`).parents(".row").find(".price").text(data.priceNone);
            }
            console.log(data);
            $(`.${data.class}`).text(`số điểm:${data.Total}`);
            $(`#qty-${data.id}`).parents(".row").find(".price").text(data.price);
        })
    }
    $(document).on("change", ".box-product .qty", function() {
        if(Number($(this).val()) < 0){
            warning_noti({title:"Thông báo",message:"Lỗi vui lòng nhập >0"});
            return $(this).val(0);
        }     
        addLoading();   
        ajaxAddProduct({qty:$(this).val(),id:$(this).attr("data-id")});
    })
     </script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
    <div class="box-product">
        <div class="box-top">
            <h2 class="title pt-3">Sản phẩm</h2>
            <form action="{{ route("employer.product.active") }}" method="POST" class="input-group py-4">
                @csrf
                <input type="text" class="form-control" name="code" placeholder="Nhập mã kích hoạt">
                <div class="input-group-prepend">
                   <button class="btn btn-success">Kích hoạt</button>
                </div>
            </form>
            <a class="map box-thumbnail">
                <img class="thumbnail" src="https://static.mservice.io/blogscontents/momo-upload-api-190911101603-637037937638948526.png" alt="">
            </a>
        </div>
        <ul class="list-product list-unstyled">
            <li class="product mb-3">
                <h3 class="title py-3 mt-4 mb-3 position-relative">Đăng tin tuyển dụng <span class="btn-arrow"><i class="fas fa-chevron-circle-up"></i></span> </h3>
                <ul class="list-package list-unstyled">
                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Đăng Tuyển Cơ Bản</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <span>
                                Thời hiệu: {{ $package[0]->Date_Expired }}ngày 
                            </span>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.1")) show @endif qty" value="{{ session("product.info.1.qty") }}" data-price="{{ $package[0]->Package_Price }}" data-id="{{ $package[0]->Package_ID }}" id="qty-{{ $package[0]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                            @if(session("product.info.1"))
                                <span class="price">{{ currency(session("product.info.1.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[0]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>

                    <!-- Việc làm mới nhất -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Việc làm mới nhất</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <span>
                                Thời hiệu:{{ $package[1]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.2")) show @endif qty" value="{{ session("product.info.2.qty") }}" data-price="{{ $package[1]->Package_Price }}" data-id="{{ $package[1]->Package_ID }}" id="qty-{{ $package[1]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                             @if(session("product.info.2"))
                                <span class="price">{{ currency(session("product.info.2.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[1]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <!-- Việc làm hấp dẫn -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Việc làm hấp dẫn</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <span>
                                Thời hiệu:{{ $package[2]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.3")) show @endif qty" value="{{ session("product.info.3.qty") }}" data-price="{{ $package[2]->Package_Price }}" data-id="{{ $package[2]->Package_ID }}" id="qty-{{ $package[2]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                            @if(session("product.info.3"))
                                <span class="price">{{ currency(session("product.info.3.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[2]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <!-- Việc làm tuyển dụng gấp -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Việc làm tuyển dụng gấp</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <span>
                                Thời hiệu:{{ $package[3]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.4")) show @endif qty" value="{{ session("product.info.4.qty") }}" data-price="{{ $package[3]->Package_Price }}" data-id="{{ $package[3]->Package_ID }}" id="qty-{{ $package[3]->Package_ID }}">
                        </div>
                        <div class="clearfix box-buy col-md-3">
                             @if(session("product.info.4"))
                                <span class="price">{{ currency(session("product.info.4.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[3]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <!-- Việc làm lương cao -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Việc làm lương cao</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span>
                                Thời hiệu:{{ $package[4]->Date_Expired }}ngày
                            </span>                           
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.5")) show @endif qty" value="{{ session("product.info.5.qty") }}" data-price="{{ $package[4]->Package_Price }}" data-id="{{ $package[4]->Package_ID }}" id="qty-{{ $package[4]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                           @if(session("product.info.5"))
                                <span class="price">{{ currency(session("product.info.5.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[4]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <!-- Việc làm cấp quản lý -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Việc làm cấp quản lý</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thời hiệu:{{ $package[5]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.6")) show @endif qty" value="{{ session("product.info.6.qty") }}" data-price="{{ $package[5]->Package_Price }}" data-id="{{ $package[5]->Package_ID }}" id="qty-{{ $package[5]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                             @if(session("product.info.6"))
                                <span class="price">{{ currency(session("product.info.6.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[5]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->
                </ul>
            </li>
            
            <li class="product mb-3">
                <h3 class="title py-3 mb-3 position-relative">Hiệu ứng tuyển dụng <span class="btn-arrow"><i class="fas fa-chevron-circle-up"></i></span> </h3>
                <ul class="list-package">
                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Hiệu ứng đỏ</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thời hiệu:{{ $package[6]->Date_Expired }}ngày
                            </span>                           
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.7")) show @endif qty" value="{{ session("product.info.7.qty") }}" data-price="{{ $package[6]->Package_Price }}" data-id="{{ $package[6]->Package_ID }}" id="qty-{{ $package[6]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                            @if(session("product.info.7"))
                                <span class="price">{{ currency(session("product.info.7.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[6]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Hiệu ứng icon hot</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thời hiệu:{{ $package[7]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.8")) show @endif qty" value="{{ session("product.info.8.qty") }}" data-price="{{ $package[7]->Package_Price }}" data-id="{{ $package[7]->Package_ID }}" id="qty-{{ $package[7]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                            @if(session("product.info.8"))
                                <span class="price">{{ currency(session("product.info.8.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[7]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->

                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Hiệu ứng uy tín</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thời hiệu:{{ $package[8]->Date_Expired }}ngày
                            </span>                            
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.9")) show @endif qty" value="{{ session("product.info.9.qty") }}" data-price="{{ $package[8]->Package_Price }}" data-id="{{ $package[8]->Package_ID }}" id="qty-{{ $package[8]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                             @if(session("product.info.9"))
                                <span class="price">{{ currency(session("product.info.9.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[8]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                    <!--  -->
                </ul>
            </li>
            <li class="product mb-3">
                <h3 class="title py-3 mb-3 position-relative">Lọc hồ sơ <span class="btn-arrow"><i class="fas fa-chevron-circle-up"></i></span></h3>
                <ul class="list-package">
                    <li class="row">
                        <div class="col-md-4">
                            <h5 class="title">Xem hồ sô ứng viên</h5>
                            <ul class="desc">
                                <li>
                                    Nhận ngay hồ sơ ứng tuyển chất lượng
                                </li>
                                <li>
                                    Dễ dàng đăng tuyển chỉ trong vài phút
                                </li>
                                <li>
                                    Mở rộng tìm kiếm ứng viên hiệu quả trên trên máy tính và các thiết bị di động
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown col-md-3">
                            <span class="package-filter" aria-haspopup="true" aria-expanded="false">
                                số điểm: {{ session("product.info.10.Qty") ?? $package[9]->Package_Value }}
                            </span>                           
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="" class="form-control @if(session("product.info.10")) show @endif qty" value="{{ session("product.info.10.qty") }}" data-price="{{ $package[9]->Package_Price }}" data-id="{{ $package[9]->Package_ID }}" id="qty-{{ $package[9]->Package_ID }}">
                        </div>
                        <div class="box-buy col-md-3">
                            @if(session("product.info.10"))
                                <span class="price">{{ currency(session("product.info.10.Total_Package_Price")) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy btn-trash"><i class="fas fa-trash-alt"></i></button>
                            @else                              
                                <span class="price">{{ currency( $package[9]->Package_Price ) }}</span>
                                <button class="btn btn-sm btn-outline-primary btn-buy">Mua thêm</button>
                            @endif
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="box-product box-total @if(session("product.total.total")) show @endif shadow">
    <span class="title">Tổng cộng (Đã bao gồm 10% thuế VAT):</span>
    <span class="total">{{ currency(session("product.total.total")) }}</span>
    <a href="{{route("employer.product.addProduct")}}" class="btn btn-primary btn-sm">Đặt hàng</a>
</div>
@endsection
@extends("admin.master.layout")
@section('title', 'Danh sách nhà tuyển dụng')
@section('css')
    {{-- require css more --}}
    {{-- plugin datatable --}}
    <link href="{{ asset("admin/plugins/datatable/css/jquery.dataTables.min.css") }}" rel="stylesheet">
@endsection

@section('js')
    {{-- require js more --}}
    {{-- plugin datatable --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    {{-- sweet-alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).on("click",".btn-job-detail",function(){
            addLoading();
            $.get("{{route('admin.employer.job.info')}}",{id:$(this).attr("job-id")},function(job){                
                $("#recruitment .thumbnail").attr("src","{{ asset("") }}"+job.data.Company_Logo);
                $("#recruitment .Job_Title").text(job.data.Job_Title);
                $("#recruitment .Company_Name").text(job.data.Company_Name);
                $("#recruitment .Job_Address").text(job.data.Job_Address);
                $("#recruitment .Job_Description").html(job.data.Job_Description);
                $("#recruitment .Job_Required").html(job.data.Job_Required);
                $("#recruitment .Job_Interest").html(job.data.Job_Interest);
                $("#recruitment .Job_Address").text(job.data.Job_Address);
                $("#recruitment .btn-accpet").attr("href",job.data.btnAccpet);
                $("#recruitment .btn-deny").attr("href",job.data.btnDeny);
                removeLoading();
                $("#recruitment.modal-more").addClass("show");
            })
        })        

        $(".modal-more .btn-exit").click(function(){
            $("#recruitment.modal-more").removeClass("show");
        })  
       var table= $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.employer.job.get") }}',
        columns: [
            { data: 'Job_ID',name:'Job_ID'},
            { data: 'Job_Title', name: 'Job_Title'},
            { data: 'Company_Name',name:'Company_Name'},
            { data: 'Service', name: 'Service' },
            { data: 'Job_Created_At',name:'Job_Created_At'},   
            { data: 'Status',name:'Status' },        
            { data: 'Action',name:'Action' }
        ]
    });

    $(document).on("click",".btn-accept",function (){
        let url=$(this).attr("data-url");
        Swal.fire({
            title: 'Thông báo',
            text: "Xác nhận đã thanh toán xong!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tiếp tục đồng ý'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href=url;
        }
})
    })

    $(document).on("click",".btn-deny",function (){
        let url=$(this).attr("data-url");
        Swal.fire({
            title: 'Thông báo',
            text: "Xác nhận từ chối dịch vụ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tiếp tục chặn'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href=url;
        }
})
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
    <!--start page wrapper -->
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
                        <li class="breadcrumb-item active" aria-current="page">Nhà tuyển dụng</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <!-- do not remove block is that -->
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="mx-auto">
            <h6 class="mb-0 text-uppercase">QUẢN TRỊ TIN ĐĂNG</h6>
            <hr />
            <div class="box-option pb-3 pt-1">
                <a href="javascript:void(0)" class="btn-hero btn-info-hero shadow mx-2" id="check-all"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0)" class="btn-hero btn-danger-hero shadow btn-delete-all" data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>
            </div>
           <table class="table table-bordered text-dark vertical-align-middle text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Tiêu đề
                        </th>
                        <th>
                           Công ty
                        </th>
                        <th>
                           Gói dịch vụ
                        </th>
                        <th>
                            Ngày tạo
                        </th>
                        <th>
                            Trạng thái
                        </th>
                        <th>
                            Tác vụ
                        </th>
                    </tr>
                </thead>
           </table>
        </div>
        <!--end row-->
    </div>
</div>
<!--end page wrapper -->

<div id="recruitment" class="modal-more">
    <div class="modal-notification text-dark">
        <button class="btn-exit btn"><i class="fas fa-times-circle"></i></button>
        <h5 class="title text-dark">Thông tin về tin tuyển dụng</h5>
        <div class="box-job-details">            
            <div class="box-top row">
                <div class="col-4 col-md-2">
                    <a href="" class="" style="width: unset; height: unset;">
                        <img class="thumbnail" src="data:image/png;base64,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" alt="">
                    </a>
                </div>
                <div class="col-8 col-md-7">
                    <h6 class="title text-dark Job_Title">Việc làm lập trình viên PHP Angular JS</h6>
                    <strong class="Company_Name">FPT Shop</strong>
                    <small class="Job_Address my-2 d-block">18H, Lầu 2, tòa nhà Sumikura, Đường Cộng Hòa, Phường 4, Quận Tân Bình, TP.HCM</small>
                    <div class="more">
                        <small class="location Province_Name"><i class="fas fa-location-arrow"></i> TPHCM</small>
                    </div>
                </div>
                <div class="box-option col-md-3">
                    <a href="" class="btn-hero btn-accpet btn-success-hero me-2"><i class="fas fa-check"></i></a>
                    <a href="" class="btn-hero btn-deny btn-danger-hero"><i class="far fa-times-circle"></i></a>
                </div>
            </div>
            <div class="box-body my-3">
                <div class="row">
                    <div class="col-md-8">
                        <div class="box-desc">
                            <h6 class="title text-dark">Mô tả công việc:</h6>
                            <div class="Job_Description">                               
                            </div>
                        </div>
                        <div class="box-require">
                            <h6 class="title text-dark">Yêu cầu công việc:</h6>
                            <div class="Job_Required">                             
                            </div>
                        </div>
                        <div class="box-interes">
                            <h6 class="title text-dark">Quyền lợi công việc</h6>
                            <div class="Job_Interest">                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="title text-dark">Thông tin tuyển dụng</h5>
                        <ul class="list-recruitment-info list-unstyled">
                            <li>
                                <span class="title">
                                    Mức lương:
                                </span>
                                <span class="content Wage">
                                    Riêng tư
                                </span>
                            </li>
                            <li>
                                <span class="title">
                                    Hình thức làm việc:
                                </span>
                                <span class="content Job_Type_Title">
                                    Riêng tư
                                </span>
                            </li>
                            <li>
                                <span class="title">
                                    Số lượng cần tuyển:
                                </span>
                                <span class="content Number_People">
                                    Riêng tư
                                </span>
                            </li>
                            <li>
                                <span class="title">
                                    Chức vụ:
                                </span>
                                <span class="content Job_Level">
                                    Riêng tư
                                </span>
                            </li>
                            <li>
                                <span class="title">
                                    Yêu cầu kinh nghiệm:
                                </span>
                                <span class="content Job_Experience Job_Experience">
                                    Riêng tư
                                </span>
                            </li>
                            <li>
                                <span class="title">
                                    Địa điểm làm việc:
                                </span>
                                <span class="content Province_Name">
                                    Riêng tư
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dialog"></div>
</div>
@endsection
@section('footer')@endsection

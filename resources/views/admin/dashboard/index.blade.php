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
        
       var table= $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.employer.service.get") }}',
        columns: [
            { data: 'ID',name:'ID'},
            { data: 'Code', name: 'Code'},
            { data: 'Code_Active',name:'Code_Active'},
            { data: 'Fullname', name: 'Fullname' },
            { data: 'Total_Price', name:'Total_Price'},
            { data: 'Buy_Created_At',name:'Buy_Created_At'},   
            { data: 'Status',name:'Status' },        
            { data: 'Action',name:'Action' }
        ],
        "order":[[6,"asc"]]
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
<div class="page-wrapper p-4">
    <h5 class="title py-3">Số liệu thống kê</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="card radius-10 bg-success bg-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Tổng thu nhập</p>
                            <h6 class="my-1 text-white">{{ currency($static->Total) }}</h6>
                        </div>
                        <div class="text-white ms-auto font-35"><i class='bx bx-comment-detail'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card radius-10 bg-primary bg-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-white">Tổng admin</p>
                            <h4 class="my-1 text-white">{{ $static->Admin }}</h4>
                        </div>
                        <div class="text-white ms-auto font-35"><i class='bx bx-cart-alt'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card radius-10 bg-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-dark">Ứng viên</p>
                            <h4 class="my-1 text-dark">{{ $static->Candidate }}</h4>
                        </div>
                        <div class="widgets-icons bg-white text-dark ms-auto"><i class="bx bxs-group"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card radius-10 bg-warning bg-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-dark">Nhà tuyển dụng</p>
                            <h4 class="text-dark my-1">{{ $static->Employer }}</h4>
                        </div>
                        <div class="text-dark ms-auto font-35"><i class='bx bx-user-pin'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tin tuyển dụng cần confirm -->
    <div class="table-recruiment">
        <h5 class="title py-3">Gói cước cần xác nhận</h5>
        <table class="table table-bordered text-dark vertical-align-middle text-center" style="width: 100%;">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Code
                    </th>
                    <th>
                        Code Kính hoạt
                    </th>
                    <th>
                        Người Mua
                    </th>
                    <th>
                        Tổng tiền 
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
</div>
<!--end page wrapper --><!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
@endsection

@section('footer')@endsection

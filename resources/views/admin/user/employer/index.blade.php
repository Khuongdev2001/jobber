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
        ajax: '{{ route("admin.user.employer.get") }}',
        columns: [
            { data:'check',name:'check'},
            { data: 'User_ID',name:'User_ID'},
            { data: 'Avatar', name: 'Avatar', orderable:false },
            { data: 'Fullname', name: 'Fullname' },
            { data: 'User_Email', name:'User_Email'},
            { data: 'User_Created_At',name:'User_Created_At'},     
            { data:'action',name:'action' }       
        ]
    });

    $(document).on("click",".table .btn-block,.table .btn-delete",function (){
        let url=$(this).attr("href");
        Swal.fire({
            title: 'Thông báo',
            text: "Bạn muốn thực hiện thao tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn tiếp tục'
        }).then((result) => {
        if (result.isConfirmed) {
          window.location.href=url;
        }
})
        return false;
    })

    actionAll("{{route('admin.user.candidate.delete')}}","{{ route('admin.user.candidate') }}");

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
            <h6 class="mb-0 text-uppercase">Danh sách nhà tuyển dụng</h6>
            <hr />
            <div class="box-option pb-3 pt-1">
                <a href="javascript:void(0)" class="btn-hero btn-info-hero shadow mx-2" id="check-all"><i class="fas fa-check"></i></a>
                <a href="javascript:void(0)" class="btn-hero btn-danger-hero shadow btn-delete-all" data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>
            </div>
           <table class="table table-bordered text-dark vertical-align-middle text-center" style="width: 100%;">
                <thead>
                    <tr>
                        <th>
    
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Ảnh
                        </th>
                        <th>
                            Họ và tên
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Ngày tạo
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
@endsection

@section('footer')@endsection

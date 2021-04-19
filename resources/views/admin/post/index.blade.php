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
        ajax: '{{ route("admin.post.get") }}',
        columns: [
            { data: 'Check',name:'Check',sortable:false},
            { data: 'Post_ID',name:'Post_ID'},
            { data: 'Thumbnail', name: 'Thumbnail'},
            { data: 'Post_Title',name:'Post_Title'},
            { data: 'Cat_Title', name: 'Cat_Title'},
            { data: 'Post_Created_At',name:'Post_Created_At'},     
            { data:'Post_Type',name:'Post_Type',sortable:false},
            { data:'Action',name:'Action',sortable:false }     
     
        ]       
    });
    $(document).on("click",".table .btn-delete",function (){
        let url=$(this).attr("data-url");
        Swal.fire({
            title: 'Xóa Bài Viết',
            text: "Bạn muốn xóa bài viết!",
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

    $(document).on("click",".box-option .btn-update",function() {
        $("#add-cat.modal-more form,#add-cat.modal-more h5").remove();
        $("#add-cat.modal-more").addClass("show");
        $("#add-cat.modal-more .modal-notification").append('<h5 class="title mb-2 text-dark">Cập nhật danh mục</h5><form method="POST" action="'+$(this).attr("href")+'"> @csrf <div class="form-group"><label for="name">Tên danh mục</label><input type="hidden" name="continue" value="{{ route("admin.post.cat") }}"><input type="text" id="name" name="Cat_Title" class="form-control" value="'+$(this).attr("title")+'"></div><div class="form-group my-2"><button class="btn-hero btn-info-hero">Cập nhật</button></div></form>');
        return false;
    })

    $(".btn-add-cat").click(function(){
        $("#add-cat.modal-more form,#add-cat.modal-more h5").remove();
        $("#add-cat.modal-more").addClass("show");
        $("#add-cat.modal-more .modal-notification").append('<h5 class="title mb-2 text-dark">Thêm nhật danh mục</h5><form method="POST" action="{{ route("admin.post.cat.add") }}"> @csrf <div class="form-group"><input type="hidden" name="continue" value="{{ route("admin.post.cat") }}"><label for="name">Tên danh mục</label><input type="text" id="name" name="Cat_Title" class="form-control" value=""></div><div class="form-group my-2"><button class="btn-hero btn-info-hero">Thêm</button></div></form>');
    })
    

    $(".btn-exit, .dialog").click(function(){
        $("#add-cat.modal-more form,#add-cat.modal-more h5").remove();
        $("#add-cat.modal-more").removeClass("show");
    })

    actionAll("{{route('admin.post.delete')}}","{{route('admin.post')}}",{title:"Thông báo",text:"xóa bài viết được chọn"});
    
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
            <div class="breadcrumb-title pe-3">Bài viết</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <!-- do not remove block is that -->
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="mx-auto">
            <h6 class="text-uppercase">Danh sách bài viết</h6>
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
                            Tiêu đề Bài viết
                        </th>
                        <th>
                            Danh mục
                        </th>
                        <th>
                            Ngày Tạo
                        </th>
                        <th>
                            Loại
                        </th>
                        <th>
                            Tác Vụ
                        </th>
                    </tr>
                </thead>
           </table>
        </div>
        <!--end row-->
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

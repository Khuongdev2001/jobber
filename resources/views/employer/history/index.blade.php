@extends("employer.master.layout")
@section("title","Lịch sử hoạt động của bạn")
@section("css")
    {{-- plugin drop image --}}
    <link rel="stylesheet" href="{{asset("employer/plugins/dropimage/css/main.css") }}">
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
@endsection

@section("js")
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
        <div class="box-profile-employer">
            <h2 class="title text-center">Thông tin chi tiết</h2>
            <nav class="box-top-controll">
                <ul class="box-option list-unstyled d-flex">
                    <li>
                        <a href="{{ route("employer.info") }}" id="label-info-employer">Nhà tuyển dụng</a>
                    </li>
                    <li>
                        <a href="{{ route("employer.company.info") }}" class="" id="label-info-company">Công ty</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="active" id="label-history">Lịch sử hoạt động</a>
                    </li>
                </ul>
            </nav>
            <form action="" class="input-group" method="GET">
                <input type="text" name="search" class="form-control" value="{{request("search")}}"  id="">
                <div class="input-group-prepend">
                    <button class="btn btn-success">Tìm Kiếm</button>
                 </div>
            </form>
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>STT</th>
                    <th>Nội Dung</th>
                    <th>Ngày</th>
                </tr>   
                @php
                    $temp=0;
                @endphp
                @foreach($historys as $history)             
                    <tr>
                        <td>{{ $temp++ }}</td>
                        <td>{{ $history->History_Content }}</td>
                        <td>{{ $history->History_Created_At }}</td>
                    </tr>      
                @endforeach                  
            </table>            
            {{ $historys->appends(["search"=>request("search")])->links() }}
        </div>
</div>
@endsection
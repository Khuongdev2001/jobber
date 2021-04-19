@extends("employer.master.layout")
@section("title","Ứng viên đã lưu")
@section("modal-login")
@parent
@endsection
@section("css")    
@endsection

@section("js")    
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<form action="" class="container">
    <div class="box-save-profile">
        <h2 class="title pt-5 pb-3 text-center">Hồ sơ đã lưu({{ $candidates->total() }})</h2>
        <div class="box-option row mb-4">
            <div class="col-md-6">
                <input type="text" class="form-control" name="search" value="{{ request("search") }}">
            </div>
            <div class="col-md-2">                
            <select name="Created_At" class="form-control">
                <option value="0" @if(request("Created_At") ==0) selected @endif>Tăng dần</option>
                <option value="1" @if(request("Created_At") ==1) selected @endif>Giảm dần</option>
            </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-success">Lọc</button>
            </div>
        </div>
        <div class="table-responsive-xl">
            <table class="table box-list-profile table-bordered text-center">
                <tr>
                    <th>
                        Avatar
                    </th>
                    <th>
                        Tên Ứng Viên
                    </th>
                    <th>
                        Sinh sống
                    </th>
                    <th>
                        Nghành nghề
                    </th>
                    <th>
                        Kinh Nghiệm
                    </th>
                    <th>
                        Ngày tạo
                    </th>
                    <th>
                        Tác vụ
                    </th>
                </tr>
                @foreach($candidates as $candidate)
                <tr class="list-profile">
                    <td class="text-center">
                        <!-- thumbnail -->
                        <a href="" class="d-block text-center box-thumbnail">
                            <img src="{{ asset($candidate->Avatar) }}" class="thumbnail" alt="{{ $candidate->Fullname }}">
                        </a>
                    </td>
                    <td>
                        <!-- title -->
                        <a href="" class="title">{{ $candidate->Fullname }}</a>
                    </td>

                    <td>
                        <a href="" class="date-created">{{ $candidate->Province_Name }}</a>
                    </td>
                    <td>
                        <a href="" class="date-updated">{{ $candidate->Name }}</a>
                    </td>
                    <td>
                        <span class="badge badge-pill badge-success">{{ __("user.Experience.{$candidate->Experience}") }}</span>
                    </td>
                    <td>
                        {{ $candidate->Created_At }}
                    </td>
                    <td>
                        <div class="box-option">
                            <a href="{{ route("employer.candidate.save.option",["id"=>$candidate->Candidate_ID,"status" => 0]) }}" class="btn-delete">Xóa</a>
                        </div>
                    </td>
                </tr>              
                @endforeach 
            </table>
        </div>
       {{ $candidates->appends(["search"=>request("search"),"Created_At"=>request("Created_At")])->links() }}
    </div>
</form>
@endsection
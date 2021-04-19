@extends("employer.master.layout")
@section("title","")
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
    <div class="box-apply-job">
        <h2 class="title pt-4 pb-3 text-center">Danh sách ứng viên ứng tuyển </h2>
        <div class="box-note shadow-sm p-3 mb-2">
            <h6 class="title text-danger">Chú ý:</h6>
            <ul class="list-unstyled">
                <li>
                    <span>+ Hãy cân nhắc lựa chọn của bạn. </span></br>
                    <span>+ Nếu bạn không đồng ý sẽ có 1 mail gửi cho bạn và ứng viên </span>
                </li>
            </ul>
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
                        Email
                    </th>
                    <th>
                        Ngành
                    </th>
                    <th>
                        Kinh Nghiệm
                    </th>
                    <th>
                        Khu vực
                    </th>
                    <th>
                        Ngày ứng tuyển
                    </th>
                    <th>
                        Tác vụ
                    </th>
                </tr>
                @foreach($candidates as $candidate)
                    @php
                        $status=["text-info","text-success","text-danger"];
                    @endphp
                    <tr class="list-profile font-weight-bold {{ $status[$candidate->Apply_Status] }}">
                        <td>
                            <a href="" class="box-thumbnail">
                                <img src="{{ asset($candidate->Avatar) }}" class="thumbnail" alt="{{ $candidate->Fullname }}">
                            </a>
                        </td>
                        <td>
                            {{ $candidate->Fullname }}
                        </td>
                        <td>
                            {{ $candidate->User_Email }}
                        </td>
                        <td>
                            {{ $candidate->Name }}
                        </td>
                        <td>
                            @if($candidate->Experience) {{ $candidate->Experience }}@else Chưa cập nhật @endif
                        </td>
                        <td>
                            {{ $candidate->Province_Name }}
                        </td>
                        <td>
                            {{ $candidate->Created_At }}
                        </td>
                        <td>
                            <div class="box-option">
                                @if($candidate->Apply_Status==0)
                                    <a href="{{ route("employer.candidate.apply.edit",["job"=>$candidate->Job_ID,"candidate"=>$candidate->Candidate_ID,"status"=>1]) }}" class="btn btn-success btn-sm btn-delete"><i class="far fa-check-circle"></i></a>
                                    <a href="{{ route("employer.candidate.apply.edit",["job"=>$candidate->Job_ID,"candidate"=>$candidate->Candidate_ID,"status"=>2]) }}" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-ban"></i></a>
                                @else                                
                                    <a href="javascipt:void(0)" class="btn btn-warning btn-sm">Đã xác nhận</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $candidates->links() }}
        <div class="clearfix">
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="feature-info feature-info-border p-xl-5 p-4 text-center">
                <div class="feature-info-icon mb-3">
                    <i class="fas fa-pen"></i>
                </div>
                <div class="feature-info-content">
                    <h5 class="text-black counter" data-number="{{ $static->Confirm }}">0</h5>
                    <p class="mb-0">Ứng viên chờ duyệt</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="feature-info feature-info-border p-xl-5 p-4 text-center">
                <div class="feature-info-icon mb-3">
                    <i class="far fa-check-circle"></i>
                </div>
                <div class="feature-info-content">
                    <h5 class="text-black counter" data-number="{{ $static->Agree }}">0</h5>
                    <p class="mb-0">Ứng viên đã duyệt</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
            <div class="feature-info feature-info-border p-xl-5 p-4 text-center">
                <div class="feature-info-icon mb-3">
                    <i class="fas fa-ban"></i>
                </div>
                <div class="feature-info-content">
                    <h5 class="text-black counter" data-number="{{ $static->Deny }}">0</h5>
                    <p class="mb-0">Ứng viên từ chối</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
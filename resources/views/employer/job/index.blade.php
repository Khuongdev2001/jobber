@extends("employer.master.layout")
@section("title","Danh sách tin tuyển dụng")
@section("css")
<link rel="stylesheet" href="http://themes.potenzaglobalsolutions.com/html/jobber/css/datetimepicker/datetimepicker.min.css">
{{-- select 2 plugin --}}
<link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
@endsection

@section("js")
<script src="https://cdn.tiny.cloud/1/vbzkm84qcbxrq5hsachp4rnckre9eor9ynuypftf4ue9e8g3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset("employer/plugins/jquery-appear/jquery.appear.js") }}"></script>
<script src="{{asset("employer/plugins/jquery-count-to/jquery.countTo.js")}}"></script>
{{-- select 2 --}}
<script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
<script src="http://themes.potenzaglobalsolutions.com/html/jobber/js/datetimepicker/moment.min.js"></script>
<script src="http://themes.potenzaglobalsolutions.com/html/jobber/js/datetimepicker/datetimepicker.min.js"></script>
<script>   
</script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")

<div class="container">
    <div class="box-list-job">
        <h2 class="title py-4 text-center">Danh sách tin tuyển dụng</h2>
        <nav class="box-option pb-4">
            <a href="{{ route("employer.job","tin-hien-dang") }}" class="badge badge-pill badge-success" class="active">Tin Đăng hiện({{ $static->Active }})</a>
            <a href="{{ route("employer.job","tin-bi-an") }}" class="badge badge-pill badge-success">Tin Bị Ẩn({{ $static->Hidden }})</a>
            <a href="{{ route("employer.job","tin-nhap") }}" class="badge badge-pill badge-dark">Tin Nháp ({{ $static->Draft }})</a>
            <a href="{{ route("employer.job","tin-cho-duyet") }}" class="badge badge-pill badge-info">Tin Chờ Duyệt ({{ $static->Confirm }})</a>
            <a href="{{ route("employer.job","tin-het-han") }}" class="badge badge-pill badge-warning">Tin hết hạn ({{ $static->Expire }})</a>
            <a href="{{ route("employer.job","tin-tu-cho") }}" class="badge badge-pill badge-danger">Tin Bị từ chối ({{ $static->Deny }})</a>
        </nav>
        <div class="box-list-job table-responsive-xl">
            <table class="table text-center table-bordered">
                <tr>
                    <th>Tiêu đề</th>
                    <th>Dịch vụ</th>
                    <th>Hết hạn</th>
                    <th>Ngày đăng</th>
                    <th>Ip</th>
                    <th>Tác vụ</th>
                </tr>   
                @foreach($jobs as $job)             
                    <tr>
                        <td>
                            {{ Str::limit($job->Job_Title,30) }}
                        </td>
                        <td>
                            @if(in_array($job->Job_Status,[1,2,-1,4]))
                                @if($job->Package_Effect)
                                    <span class="badge bg-danger text-white">{{ $job->Package_Effect }}</span>
                                @endif
                                <span class="badge bg-success text-white">{{ $job->Package_Post }}</span>
                            @endif
                        </td>
                        <td>
                            @if($job->Job_Status==4)
                            <span>Gần {{ round(($job->Package_Post_Expire-time())/86400) }} ngày</span>
                            @else
                            <span>Không có dịch vụ</span>
                            @endif
                            
                        </td>
                        <td>
                            <span>{{ date("Y-m-d H:i:s",$job->Job_Created_At) }}</span>
                        </td>
                        <td>
                            <span>{{ $job->Ip }}</span>
                        </td>
                        <td>
                            <div class="box-option text-center">
                                <a href="{{ route("employer.job.update",["slug"=>$job->Job_Slug]) }}" class="btn btn-info btn-sm btn-update" data-id="10"><i class="fas fa-pen"></i></a>
                                {{-- chỉ có bài viết đã đăng hoặc bị ẩn bới nhà tuyển dụng mới hiên --}}
                                @php
                                    $action=[
                                        -1=>"far fa-eye",
                                        4=>"fas fa-eye-slash"
                                    ]
                                @endphp
                                @if($job->Job_Status==4)
                                    <a href="{{ route("employer.candidate.apply",["id"=>$job->Job_ID]) }}" class="btn btn-success btn-sm">Ứng viên</a>
                                @endif
                                @if(array_key_exists($job->Job_Status,$action))
                                    <a href="{{ route("employer.job.action",["id"=>$job->Job_ID,"status"=>$job->Job_Status]) }}" class="btn btn-success btn-sm"><i class="{{ $action[$job->Job_Status] }}"></i></a>
                                @endif
                                @if($job->Job_Status==0)
                                    <!-- chỉ có tin nháp mới được quyền xóa -->
                                    <a href="" class="btn btn-danger btn-sm btn-delete" data-id="10"><i class="fas fa-trash-alt"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>      
                @endforeach                  
            </table>
            {{ $jobs->appends(["search"=>request("search")])->links() }}
        </div>
    </div>
</div><!--=================================
Footer-->
<footer class="footer mt-0">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">For Candidates</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Browse Jobs</a></li>
                        <li><a href="#">Browse Categories</a></li>
                        <li><a href="#">Submit Resume</a></li>
                        <li><a href="#">Candidate Dashboard</a></li>
                        <li><a href="#">Job Alerts</a></li>
                        <li><a href="#">My Bookmarks</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">For Employers</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Browse Candidates</a></li>
                        <li><a href="#">Browse Categories</a></li>
                        <li><a href="#">Employer Dashboard</a></li>
                        <li><a href="#">Add Job</a></li>
                        <li><a href="#">Job Packages</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">Partner Sites</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Shortcodes</a></li>
                        <li><a href="#">Job Page</a></li>
                        <li><a href="#">Job Page Alternative </a></li>
                        <li><a href="#">Resume Page</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="contact-us.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-contact-info bg-holder" style="background-image: url(images/google-map.png);">
                    <h5 class="text-dark mb-4">Contact Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li> <i class="fas fa-map-marker-alt text-primary"></i><span>214 West Arnold St. New York, NY 10002</span> </li>
                        <li> <i class="fas fa-mobile-alt text-primary"></i><span>+(123) 345-6789</span> </li>
                        <li> <i class="far fa-envelope text-primary"></i><span>support@jobber.demo</span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="border-bottom"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center text-md-left">
                    <p class="mb-0"> &copy;Copyright <span id="copyright">
                            <script>
                                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                            </script>
                        </span> <a href="#"> Jobber </a> All Rights Reserved </p>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="social d-flex justify-content-lg-end justify-content-center">
                        <ul class="list-unstyled">
                            <li class="facebook"><a href="#">FB</a></li>
                            <li class="twitter"><a href="#">TW</a></li>
                            <li class="linkedin"><a href="#">IN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--=================================
Footer-->

<!--=================================
Back To Top-->
<div id="back-to-top" class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>
<!--=================================
Back To Top-->

<!--=================================
Signin Modal Popup -->
<div class="modal fade model-login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h4 class="mb-0 text-center">Tác vụ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login-register">
                    <fieldset>
                        <legend class="px-2">Chọn loại tác vụ</legend>
                        <ul class="nav nav-tabs nav-tabs-border d-flex" role="tablist">
                            <li class="nav-item mr-4">
                                <a class="nav-link active" data-toggle="tab" href="#box-login" role="tab" aria-selected="false">
                                    <div class="d-flex">
                                        <div class="ml-3">
                                            <h6 class="mb-0">Đăng nhập</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#box-forget-pass" role="tab" aria-selected="false">
                                    <div class="d-flex">
                                        <div class="ml-3">
                                            <h6 class="mb-0">Quên mật khẩu</h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </fieldset>
                    <div class="tab-content">
                        <div class="tab-pane active" id="box-login" role="tabpanel">
                            <form class="mt-4">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="Email2">Email:* </label>
                                        <input type="text" class="form-control" id="Email22">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="password2">Password:* </label>
                                        <input type="password" class="form-control" id="password32">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <a class="btn btn-primary btn-block" href="#">Đăng nhập</a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="ml-md-3 mt-3 mt-md-0 forgot-pass">
                                            <p class="mt-1">Bạn chưa có tài khoản <a href="?module=user&action=reg">Đăng ký</a></p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="box-forget-pass" role="tabpanel">
                            <form class="mt-4">
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="Email2">Email:</label>
                                        <input type="text" class="form-control" id="Email2">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <a class="btn btn-primary btn-block" href="#">Xác nhận</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if(session('employer'))
{{-- header done login --}}
<header class="header bg-dark">
    <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
        <div class="container-fluid">
            <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a class="navbar-brand" href="{{ route("employer.home") }}">
                <img class="img-fluid" src="{{asset("employer/img/logo.svg") }}" alt="logo">
            </a>
            <div class="navbar-collapse collapse justify-content-start">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown {{ setMenuActive("employer.home","employer") }}">
                        <a class="nav-link" href="{{ route("employer.home") }}" id="navbarDropdown">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown {{ setMenuActive("employer.dashboard","employer") }}">
                        <a class="nav-link" href="{{ route("employer.dashboard") }}" id="navbarDropdown">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown {{ setMenuActive("employer.job","employer") }} {{ setMenuActive("employer.job.add","employer") }}">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tuyển dụng <i class="fas fa-chevron-down fa-xs"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route("employer.job.add")}} ">Đăng bài</a></li>
                            <li><a class="dropdown-item" href="{{ route("employer.job") }}">Danh sách tin tuyển dụng</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item {{ setMenuActive("employer.candidate","employer") }} {{ setMenuActive("employer.candidate.save","employer") }}">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown">Ứng viên<i class="fas fa-chevron-down fa-xs"></i></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route("employer.candidate") }}">Ứng viên</a></li>
                            <li><a class="dropdown-item" href="{{ route("employer.candidate.save") }}">Hồ sơ đã lưu</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown {{ setMenuActive("employer.product.buy","employer") }} ">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dịch vụ<i class="fas fa-chevron-down fa-xs"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route("employer.product.buy") }}">Mua gói dịch vụ</a></li>
                            <li><a class="dropdown-item" href="employer-grid.html">Danh sách đơn hơn</a></li>
                        </ul>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="{{ route("post") }}" class="nav-link">Bài viết</a>
                    </li>
                </ul>
            </div>
            <div class="add-listing d-flex align-items-sm-center pr-3">
                <div class="box-avatar dropdown d-inline-block mr-4">
                    <a href="" id="dropdown-profile" class="box-thumbnail dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @php
                            $url="employer/img/avatars/default-".session("employer.Gender").".jpg";
                            if(!empty(session("employer.Avatar"))){
                                $url=session("employer.Avatar");
                            }
                        @endphp
                        <img class="thumbnail img-fluid" src="{{ asset($url) }}" alt="">
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="dropdown-profile">
                        <a class="dropdown-item btn-info" href="{{ route("employer.info") }}">{{ session("employer.Fullname") }}</a>
                        <a class="dropdown-item btn-info-company" href="{{ route("employer.company.info") }}">Thông tin công ty</a>
                        <a class="dropdown-item btn-history" href="{{ route("employer.history") }}">Lịch sử hoạt động</a>
                        <a class="btn btn-danger" href="{{ route("employer.logout") }}">Đăng xuất</a>
                    </div>
                </div>
                <div class="box-ring position-relative">
                    <span class="number">10</span>
                    <a href="{{ route("employer.history") }}" id="btn-notification"><i class="far fa-bell"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>
@else
{{-- header chưa login  --}}
<header class="header bg-dark">
    <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
        <div class="container-fluid">
            <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a href="{{ route("employer.home") }}" class="navbar-brand" href="index.html">
                <img class="img-fluid" src="{{ asset("employer/img/logo.svg") }}" alt="logo">
            </a>
            <div class="navbar-collapse collapse justify-content-start">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown">Trang chủ</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="{{ route("post") }}" class="nav-link">Bài viết</a>
                    </li>
                </ul>
            </div>
            <div class="add-listing">
                <div class="login d-inline-block mr-4">
                    <a href="login.html" id="btn-login" data-toggle="modal" data-target=".model-login"><i class="far fa-user pr-2"></i>Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>
</header>
@endif
<header id="home" class="hero-area">
   @if(empty($setMenuPost)) 
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar">
        <div class="container">
            <div class="theme-header clearfix">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="{{ route("home") }}" class="navbar-brand"><img src="{{ asset("candidate/imgs/logo.png")}}" alt="jobber"></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item dropdown {{ setMenuActive("home","candidate") }}">
                            <a class="nav-link dropdown-toggle" href="{{ route("home") }}">
                                Trang chủ
                            </a>
                        </li>
                        <li class="nav-item {{ setMenuActive("job","candidate") }}">
                            <a class="nav-link dropdown-toggle" href="{{ route("job") }}">
                                Việc làm
                            </a>
                        </li> 
                        <li class="nav-item {{ setMenuActive("company","candidate") }}">
                            <a class="nav-link dropdown-toggle" href="{{ route("company") }}">
                                Công ty
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="{{ route("post.home") }}" class="nav-link dropdown-toggle">
                                Cẩm nang
                            </a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="blog.html">Hello</a></li>
                            </ul>
                        </li> --}}
                        @if(session("candidate"))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-inline-block" style="width: 75px" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @php                                    
                                    $url=session("candidate.Avatar") ?? "candidate/imgs/company/default.webp";                                   
                                @endphp
                                <img class="thumbnail rounded-circle" src="{{ asset($url) }}" alt="">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route("info") }}">{{ session("candidate.Fullname") }}</a></li>
                                <li><a class="dropdown-item" href="{{ route("jobSave") }}">Công việc đã lưu</a></li>
                                <li><a class="dropdown-item" href="{{ route("logout") }}">Đăng xuất</a></li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("login") }}">Sign In</a>
                        </li>
                        @endif
                        <li class="button-group">
                            <a href="{{ route("employer.home") }}" class="button btn btn-common">Tuyển dụng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu" data-logo="{{ asset("candidate/imgs/logo-mobile.png") }}"></div>
    </nav>
    @else
    <nav class="navbar navbar-expand-lg fixed-top scrolling-navbar navbar-post">
        <div class="container d-block">
            <div class="top position-relative">
                <form action="{{ route("post") }}" class="top-search-post">
                    <input type="text" placeholder="Tìm kiếm" value="{{ request("search") }}" name="search" id="search" class="form-control form-control-sm d-inline-block">
                    <button class="btn-search"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="theme-header clearfix">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                        <span class="lni-menu"></span>
                    </button>
                    <a href="{{ route("home") }}" class="navbar-brand"><img src="{{asset("candidate/imgs/logo.png")}}" alt="jobber"></a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item dropdown">
                            <a href="{{ route("home") }}" class="nav-link dropdown-toggle" href="?d">
                                Việc Làm
                            </a>
                        </li>
                        <li class="nav-item {{ setMenuActive("post.home","candidate") }}">
                            <a href="{{ route("post.home") }}" class="nav-link dropdown-toggle" href="?module=post&action=cat">
                                Trang chủ
                            </a>
                        </li>
                        @foreach($setMenuPost["menus"] as $menu)
                        <li class="nav-item">
                            <a href="{{ route("post",["cat"=>$menu->Cat_ID]) }}" class="nav-link dropdown-toggle" href="?module=post&action=cat">
                                {{ $menu->Cat_Title }}
                            </a>
                        </li>
                        @endforeach
                        <li class="nav-item dropdown">
                            <a href="" class="nav-link dropdown-toggle btn-open-search-post"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mobile-menu bg-white align-items-center justify-content-between" data-logo="{{ asset("candidate/imgs/logo-mobile.png") }}">
            <div class="btn-option">
                <a href="" class="nav-link dropdown-toggle btn-open-search-post"><i class="fas fa-search"></i></a>
            </div>
        </div>
    </nav>
    @endif
    @if(!empty($setSearchMenu))
    <div class="container">
        <div class="contents pb-2">
            <form action="{{ route("job") }}" class="row job-search-form mx-0">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="form-control" type="text" value="{{ request("Job_Title") }}" name="Job_Title" placeholder="Tên công việc">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="search-category-container">
                            <label class="styled-select">
                                <select name="Province_ID">                          
                                    <option value="">Tỉnh Thành</option>         
                                    @foreach( $dataSearch["provinces"] as $province )
                                        <option value="{{ $province->Province_ID }}" @if($province->Province_ID == request("Province_ID")) selected @endif>{{ $province->Province_Name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="search-category-container">
                            <label class="styled-select">
                                <select name="Specialize_ID">
                                    <option value="">Nghành</option>
                                    @foreach( $dataSearch["specializes"] as $specialize )
                                        <option value="{{ $specialize->Specialize_ID }}" @if($specialize->Specialize_ID == request("Specialize_ID")) selected @endif>{{ $specialize->Name }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <i class="fas fa-tools"></i>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="button w-100"><i class="lni-search"></i></button>
                </div>
                <div class="col-12 my-2">
                    <a href="#" id="btn-open-seach-advanced" class="text-white float-right">Chọn tìm kiếm nâng cao</a>
                </div>
                <div class="col-12 seach-adanced">
                </div>
            </form>
        </div>
    </div>
    @endif
    @if(!empty($setSearchCompany))        
    <div id="box-search-company">
        <div class="container">
            <div class="box-search">
                <h5 class="title">Tra cứu thông tin trên The Hunt</h5>
                <form class="form-search" action="">
                    <div class="form-group">
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request("search") }}">
                    </div>
                    <div class="form-group">
                        <button class="btn-search"><i class="fas fa-search"></i> Tìm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if(!empty($setHome))
    <div class="container">
        <div class="row space-100">
            <div class="col-lg-7 col-md-12 col-xs-12">
                <div class="contents">
                    <h2 class="head-title">Find the <br> job that fits your life</h2>
                    <p>Aliquam vestibulum cursus felis. In iaculis iaculis sapien ac condimentum. Vestibulum congue posuere lacus, id tincidunt nisi porta sit amet. Suspendisse et sapien varius, pellentesque dui non.</p>
                    <div class="job-search-form">
                        <form action="{{ route("job") }}">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" name="Job_Title" type="text" placeholder="Tìm kiếm việc làm" value="{{ request("Job_Title") }}">
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <div class="form-group">
                                        <div class="search-category-container">
                                            <label class="styled-select">
                                                <select name="Job_Type">
                                                    @foreach(__("user.Job_Type") as $key => $jobType)
                                                        <option value="{{$key}}" @if(request("Job_Type")==$key) selected  @endif>{{ $jobType }}</option>
                                                    @endForeach
                                                </select>
                                            </label>
                                        </div>
                                        <i class="lni-map-marker"></i>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-12">
                                    <button type="submit" class="button"><i class="lni-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-xs-12">
                <div class="intro-img">
                    <img src="{{ asset("candidate/imgs/intro.png")}}" alt="trang chủ jobber">
                </div>
            </div>
        </div>
    </div>
    @endif
    </header>
<!doctype html>
<html lang="en">

<head>
    {{-- multi window --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- icon --}}
    <link rel="icon" href="{{ asset("admin/images/favicon-32x32.png") }}" type="image/png" />
    {{-- loader --}}
    <link href="{{ asset("admin/css/pace.min.css") }}" rel="stylesheet" />
    <script src="{{ asset("admin/js/pace.min.js") }}"></script>

    {{-- simplebar --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/simplebar/css/simplebar.css") }}">

    <link href="{{ asset("admin/plugins/metismenu/css/metisMenu.min.css")}} " rel="stylesheet" />
    {{-- bootstrap --}}
    <link href="https://codervent.com/dashtreme/demo/vertical/assets/css/bootstrap.min.css" rel="stylesheet">
    {{-- font google --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    {{-- main css --}}
    <link href="{{ asset("admin/css/app.css") }}" rel="stylesheet">
    <link href="{{ asset("admin/css/icons.css") }}" rel="stylesheet">
    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{ asset("admin/fonts/fontawesome/css/all.css") }}" >
    {{-- notitification --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/notifications/css/lobibox.min.css") }}">
    @yield("css")
    <title>@yield("title")</title>
</head>

<body class="bg-theme bg-theme1">
    <!--wrapper-->
    <div class="wrapper">
        @section('sidebar')
            <div class="sidebar-wrapper" data-simplebar="true">
                <div class="sidebar-header">
                    <div>
                        <img src="{{ asset("admin/images/logo-icon.png") }}" class="logo-icon" alt="logo icon">
                    </div>
                    <div>
                        <h4 class="logo-text">Dashtreme</h4>
                    </div>
                    <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
                </div>
                <!--navigation-->
                <ul class="metismenu" id="menu">
                    <li class="{{ setMenuActive("admin.dashboard","admin") }}">
                        <a class="" href="{{ route("admin.dashboard") }}">
                            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                            <div class="menu-title">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div class="parent-icon"><i class="fab fa-facebook-messenger"></i></div>
                            <div class="menu-title">Tin nhắn(Chưa làm)</div>
                        </a>
                    </li>
                    <li class="{{ setMenuActive("admin.employer.service","admin")}}">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="bx bx-category"></i></div>
                            <div class="menu-title">Dịch vụ</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route("admin.employer.service") }}"><i class="bx bx-right-arrow-alt"></i>Giao dịch gói</a>
                            </li>
                            <li>
                                <a href="{{ route("admin.employer.job") }}"><i class="bx bx-right-arrow-alt"></i>Tin tuyển dụng</a>
                            </li>
                        </ul>
                    </li>

                    <!-- menu user -->
                    <li class="menu-label">Quản trị thành viên</li>
                    <li class="">
                        <a class="has-arrow" href="javascript:;">
                            <div class="parent-icon"><i class='bx bx-message-square-edit'></i></div>
                            <div class="menu-title">Ứng viên</div>
                        </a>
                        <ul>
                            <li class="{{ setMenuActive("admin.user.candidate","admin") }}">
                                <a href="{{ route("admin.user.candidate") }}"><i class="bx bx-right-arrow-alt"></i>Danh sách ứng viên</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:;">
                            <div class="parent-icon"><i class="bx bx-grid-alt"></i></div>
                            <div class="menu-title">Nhà tuyển dụng</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route("admin.user.employer") }}"><i class="bx bx-right-arrow-alt"></i>Danh sách nhà tuyển dụng</a>
                            </li>
                            <li>
                                <a href="?module=employer&action=recruitment"><i class="bx bx-right-arrow-alt"></i>Quản trị tin đăng nhà tuyển dụng</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:;">
                            <div class="parent-icon"><i class="bx bx-lock"></i></div>
                            <div class="menu-title">Thành viên admin</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route("admin.user.admin.add") }}"><i class="bx bx-right-arrow-alt"></i>Thêm admin</a>
                            </li>
                            <li>
                                <a href="{{ route("admin.user.admin") }}"><i class="bx bx-right-arrow-alt"></i>Danh sách admin</a>
                            </li>
                        </ul>
                    </li>
                    <!-- end menu user -->

                    <li class="menu-label">Bài viết</li>
                    <li>
                        <a class="has-arrow" href="javascript:;">
                            <div class="parent-icon"><i class="bx bx-lock"></i></div>
                            <div class="menu-title">Quản lý cẩm nang</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route("admin.post.add") }}"><i class="bx bx-right-arrow-alt"></i>Thêm bài viết</a>
                            </li>
                            <li>
                                <a href="{{ route("admin.post.cat") }}"><i class="bx bx-right-arrow-alt"></i>Danh mục</a>
                            </li>
                            <li>
                                <a href="{{ route("admin.post") }}"><i class="bx bx-right-arrow-alt"></i>Bài viết</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-label">Tuyển dụng</li>
                    <li>
                        <a class="has-arrow" href="javascript:;">
                            <div class="parent-icon"><i class="bx bx-lock"></i></div>
                            <div class="menu-title">Cấu hình</div>
                        </a>
                        <ul>
                            <li class="{{ setMenuActive("admin.package.config","admin") }}">
                                <a href="{{ route("admin.package.config") }}"><i class="bx bx-right-arrow-alt"></i>Cấu hình gói</a>
                            </li>
                        </ul>
                    </li>
                 
                </ul>
                <!--end navigation-->
            </div>
        @show
        @section('header')
            <header>
                <div class="topbar d-flex align-items-center">
                    <nav class="navbar navbar-expand">
                        <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
                        <div class="search-bar flex-grow-1">
                            <div class="position-relative search-bar-box">
                                <span class="position-absolute top-50 search-close translate-middle-y">
                                    <i class='bx bx-x'></i>
                                </span>
                            </div>
                        </div>
                        <div class="top-menu ms-auto">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item mobile-search-icon">
                                    <a class="nav-link" href="#">
                                        <i class='bx bx-search'></i>
                                    </a>
                                </li>
                                <li class="nav-item dropdown dropdown-large">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false"><i class='bx bx-category'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <div class="row row-cols-3 g-3 p-3">
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-group'></i></div>
                                                <div class="app-title">Teams</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-atom'></i></div>
                                                <div class="app-title">Projects</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-shield'></i></div>
                                                <div class="app-title">Tasks</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-notification'></i></div>
                                                <div class="app-title">Feeds</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-file'></i></div>
                                                <div class="app-title">Files</div>
                                            </div>
                                            <div class="col text-center">
                                                <div class="app-box mx-auto"><i class='bx bx-filter-alt'></i></div>
                                                <div class="app-title">Alerts</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown dropdown-large">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="alert-count">7</span>
                                        <i class='bx bx-bell'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:;">
                                            <div class="msg-header">
                                                <p class="msg-header-title">Notifications</p>
                                                <p class="msg-header-clear ms-auto">Marks all as read</p>
                                            </div>
                                        </a>
                                        <div class="header-notifications-list">
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-group"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">New Customers<span class="msg-time float-end">14 Sec ago</span></h6>
                                                        <p class="msg-info">5 new user registered</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-cart-alt"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min ago</span></h6>
                                                        <p class="msg-info">You have recived new orders</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-file"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">24 PDF File<span class="msg-time float-end">19 min ago</span></h6>
                                                        <p class="msg-info">The pdf files generated</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-send"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Time Response <span class="msg-time float-end">28 min ago</span></h6>
                                                        <p class="msg-info">5.1 min avarage time response</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-home-circle"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">New Product Approved <span class="msg-time float-end">2 hrs ago</span></h6>
                                                        <p class="msg-info">Your new product has approved</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class="bx bx-message-detail"></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">New Comments <span class="msg-time float-end">4 hrs ago</span></h6>
                                                        <p class="msg-info">New customer comments recived</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class='bx bx-check-square'></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs ago</span></h6>
                                                        <p class="msg-info">Successfully shipped your item</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class='bx bx-user-pin'></i></div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day ago</span></h6>
                                                        <p class="msg-info">24 new authors joined last week</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="notify"><i class='bx bx-door-open'></i>a </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Defense Alerts <span class="msg-time float-end">2 weeks ago</span></h6>
                                                        <p class="msg-info">45% less alerts last 4 weeks</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a href="javascript:;">
                                            <div class="text-center msg-footer">View All Notifications</div>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown dropdown-large">
                                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="alert-count">8</span>
                                        <i class='bx bx-comment'></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="javascript:;">
                                            <div class="msg-header">
                                                <p class="msg-header-title">Messages</p>
                                                <p class="msg-header-clear ms-auto">Marks all as read</p>
                                            </div>
                                        </a>
                                        <div class="header-message-list">
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-1.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Daisy Anderson <span
                                                                class="msg-time float-end">5 sec
                                                                ago</span></h6>
                                                        <p class="msg-info">The standard chunk of lorem</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-2.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Althea Cabardo <span
                                                                class="msg-time float-end">14
                                                                sec ago</span></h6>
                                                        <p class="msg-info">Many desktop publishing packages</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-3.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Oscar Garner <span class="msg-time float-end">8
                                                                min
                                                                ago</span></h6>
                                                        <p class="msg-info">Various versions have evolved over</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-4.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Katherine Pechon <span
                                                                class="msg-time float-end">15
                                                                min ago</span></h6>
                                                        <p class="msg-info">Making this the first true generator</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-5.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Amelia Doe <span class="msg-time float-end">22
                                                                min
                                                                ago</span></h6>
                                                        <p class="msg-info">Duis aute irure dolor in reprehenderit</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-6.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Cristina Jhons <span
                                                                class="msg-time float-end">2 hrs
                                                                ago</span></h6>
                                                        <p class="msg-info">The passage is attributed to an unknown</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-7.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">James Caviness <span
                                                                class="msg-time float-end">4 hrs
                                                                ago</span></h6>
                                                        <p class="msg-info">The point of using Lorem</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-8.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Peter Costanzo <span
                                                                class="msg-time float-end">6 hrs
                                                                ago</span></h6>
                                                        <p class="msg-info">It was popularised in the 1960s</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-9.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">David Buckley <span
                                                                class="msg-time float-end">2 hrs
                                                                ago</span></h6>
                                                        <p class="msg-info">Various versions have evolved over</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-10.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Thomas Wheeler <span
                                                                class="msg-time float-end">2 days
                                                                ago</span></h6>
                                                        <p class="msg-info">If you are going to use a passage</p>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="javascript:;">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-online">
                                                        <img src="public/images/avatars/avatar-11.png" class="msg-avatar"
                                                            alt="user avatar">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="msg-name">Johnny Seitz <span class="msg-time float-end">5
                                                                days
                                                                ago</span></h6>
                                                        <p class="msg-info">All the Lorem Ipsum generators</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a href="javascript:;">
                                            <div class="text-center msg-footer">View All Messages</div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="user-box dropdown">
                            <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(session("admin.Avatar")) }}" class="user-img" alt="user avatar">
                                <div class="user-info ps-3">
                                    <p class="user-name mb-0">{{ session("admin.Fullname") }}</p>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route("admin.user.admin.info",session("admin.User_Email") ?? "no email") }}"><i class="bx bx-user"></i><span>Thông tin</span></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
        @show
        @yield("content")
        @section('footer')
            <div class="overlay toggle-icon"></div>
            <a href="javaScript:;" class="back-to-top"><i
                    class='bx bxs-up-arrow-alt'></i></a>
            <footer class="page-footer">
                <p class="mb-0">Copyright © 2021. All right reserved.</p>
            </footer>
        </div>
        <div class="switcher-wrapper">
            <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
            </div>
            <div class="switcher-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                    <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
                </div>
                <hr />
                <p class="mb-0">Gaussian Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>
                <hr>
                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>
            </div>
        </div>
    @show
    <script src="{{ asset("admin/framework/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("admin/library/jquery/js/jquery-min.js") }}"></script>
    <script src="{{ asset("admin/plugins/simplebar/js/simplebar.min.js") }}"></script>
    <script src="{{ asset("admin/plugins/metismenu/js/metisMenu.min.js") }}"></script>
    <script src="{{ asset("admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("admin/plugins/notifications/js/lobibox.min.js") }}"></script>
    <script src="{{ asset("admin/plugins/notifications/js/notifications.min.js") }}"></script>
    <script src="{{ asset("admin/plugins/notifications/js/notification-custom-script.js") }}"></script>
    <script src="{{ asset("admin/js/app.js") }}"></script>
    @yield("js")    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</body>
    {{-- notification --}}
    @if ($errors->any() || session("error") || session("success"))
    <script>
        @foreach ($errors->all() as $error)
              error_noti({ title:"Lỗi Người Dùng", message:"{{ $error }}"})
        @endforeach

        @if(session("error"))
            error_noti({ title:"{{ session('error.title') }}", message:"{{ session('error.message') }}"})
        @endif        

        @if(session("success"))
            success_noti({title:"{{ session('success.title') }}",message:"{{ session('success.message') }}"} )
        @endif
    </script>  
    @endif
</html>

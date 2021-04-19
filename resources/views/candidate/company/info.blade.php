@extends("candidate.master.index")
@section("title",$company->Company_Name)
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="box-company-detail">
    <div class="box-top">
        <div class="container">
            <div class="box-cover">
                @php
                    $url="https://www.topcv.vn/images/default_cover/topcv_cover_vp2.jpg";
                    if($company->Company_Cover)
                    {
                        $url=asset($company->Company_Cover);
                    }
                @endphp
                <a href="" class="box-thumbnail"><img class="thumbnail" src="{{ $url }}" alt="{{ $company->Company_Name }}"></a>
            </div>
            <div class="box-info-basic d-flex flex-wrap">
                <div class="box-avatar">
                    @php
                        $url=$company->Company_Logo ?:"candidate/imgs/avatars/default.jpg";
                    @endphp
                    <a href="" class="box-thumbnail"><img class="thumbnail" src="{{ asset($url) }}" alt="{{ $company->Company_Name }}"></a>
                </div>
                <div class="box-info">
                    <h4 class="title">{{ $company->Company_Name }}</h4>
                    <div class="static">
                        <a href="" class="link"><i class="fas fa-link"></i>{{ $company->Company_Website }}</a>
                        <a href="" class="size"><i class="fas fa-users"></i>{{ __("user.Company_Size.{$company->Company_Size}") }}</a>
                    </div>
                </div>
                <div class="option">
                    <div class="">
                        <a href="" class="btn-follow">Theo dõi</a>
                        <a href="" class="job-same">Việc liên quan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body pb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
            <div class="box-info-detail row">
                <h4 class="title col-12 pb-3 pt-2">GIỚI THIỆU CÔNG TY</h4>
                <div class="box-left col-md-8">
                    <div class="introduce">
                        {{ $company->Company_Description }}
                    </div>
                </div>
                <div class="box-right col-md-4">
                    <div class="box-location mb-3">
                        <h5 class="title">THÔNG TIN CÔNG TY</h5>
                        <div class="location">
                            <span class="text"><i class="lni-map-marker"></i>{{ $company->Company_Address }}</span>
                            <div class="map">
                                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $company->Company_Address }}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="box-share mb-3">
                        <h5 class="title">CHIA SẺ CÔNG TY TỚI BẠN BÈ</h5>
                        <div class="option-social">
                            <a href="" class="facebook"><i class="fab fa-facebook-f"></i></a>
                        </div>
                    </div>
                    <div class="box-advertisement">
                        <a href="" class="box-thumbnail"><img class="thumbnail" src="https://www.topcv.vn/v3/images/tinh-luong-gross-net.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

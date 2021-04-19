@extends("candidate.master.index")
@section("title","Danh sách công ty")
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="result-search clearfix" id="static-result">
                <div class="key-search float-left">
                    Tìm công ty <span class="result">{{ request("search") }}</span>
                </div>
                <div class="num-compay float-right">
                    TopCV gợi ý <span class="result">{{ $companys->total() }}</span> công ty phù hợp
                </div>
            </nav>
        </div>
        <div class="box-left col-md-8">
            <ul class="box-list-company">
                @foreach($companys as $company)
                <li class="list-company">
                    @php
                        $url= $company->Company_Logo ?: "candidate/imgs/company/default.webp";
                    @endphp
                    <a href="{{ route("company.info",["slug"=>$company->Company_Slug]) }}" class="box-thumbnail"><img class="thumbnail" src="{{ asset($url) }}" alt=""></a>
                    <a href="{{ route("company.info",["slug"=>$company->Company_Slug]) }}" class="info">
                        <h5 class="name">{{ $company->Company_Name }}</h5>
                        <span class="address"> <i class="lni-map-marker"></i>{{ $company->Company_Address }}</span>
                        <p class="desc">
                           {{ Str::limit($company->Company_Description,50) }}
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
            {{ $companys->appends(["search"=>request("search")])->links() }}
        </div>
        <div class="box-right col-md-4">
            <h4 class="title">Nhà tuyển dụng nổi bật</h4>
            <ul class="list-company-light">
                <li class="icon-company">
                    <a href="" class="box-thumbnail">
                        <img src="https://static.topcv.vn/company_logos/he-thong-ban-le-viettel-store-cong-ty-tm-xnk-viettel-604ad1fb02721.jpg" class="thumbnail" alt="">
                    </a>
                </li>
                <li class="icon-company">
                    <a href="" class="box-thumbnail">
                        <img src="https://static.topcv.vn/company_logos/he-thong-ban-le-viettel-store-cong-ty-tm-xnk-viettel-604ad1fb02721.jpg" class="thumbnail" alt="">
                    </a>
                </li>
                <li class="icon-company">
                    <a href="" class="box-thumbnail">
                        <img src="https://static.topcv.vn/company_logos/he-thong-ban-le-viettel-store-cong-ty-tm-xnk-viettel-604ad1fb02721.jpg" class="thumbnail" alt="">
                    </a>
                </li>
                <li class="icon-company">
                    <a href="" class="box-thumbnail">
                        <img src="https://static.topcv.vn/company_logos/he-thong-ban-le-viettel-store-cong-ty-tm-xnk-viettel-604ad1fb02721.jpg" class="thumbnail" alt="">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection

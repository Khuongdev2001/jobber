@extends("candidate.master.index")
@section("title",$job->Job_Title)
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="page-header pt-5 pb-2">
    <div class="container">
        <div class="row job-detail">
            <div class="col-lg-8 col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper">
                    <div class="img-wrapper">
                        <img src="{{ asset($job->Company_Logo) }}" alt="{{ $job->Job_Title }}">
                    </div>
                    <div class="content">
                        <h3 class="product-title">{{ $job->Job_Title }}</h3>
                        <p class="company-name">{{ $job->Company_Name }}</p>
                        <span class="work-at">{{ $job->Job_Address }}</span>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i>{{ $job->Province_Name }}</span>
                            <span><i class="lni-calendar"></i>{{ date("Y-m-d",$job->Job_Created_At) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 box-btn-action">
                @if(!$check->ID)
                    <a href="{{ route("jobSave.option",$job->Job_ID) }}" class="btn-save-jobs"><i class="far fa-heart"></i> Lưu việc</a>
                @else
                    <a href="javascript:void(0)" class="btn-save-jobs btn-common done"></i>Đã lưu</a>
                @endif
                @if($checkApply)
                    <a href="javascript:void(0)" class="btn-apply-jobs btn-common done">Đã ứng tuyển</a>
                @else
                    <a href="{{ route("job.apply",$job->Job_ID) }}" class="btn-apply-jobs btn-common">Ứng tuyển</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="job-detail container">
    <ul class="row tab-company">
        <li class="col-md-3 col-12">
            <a href="javascript:void(0)" class="nav-item post active">Tin tuyển dụng</a>
        </li>
        <li class="col-md-3 col-12">
            <a href="{{ route("company.info",$job->Company_Slug) }}" class="nav-item info-company">Thông tin công ty</a>
        </li>
        <li class="col-md-3 col-sm-4 col-12">
            <a href="{{ route("job",["Specialize_ID"=>$job->Specialize_ID]) }}" class="nav-item same-cat">Cùng thể loại</a>
        </li>
    </ul>
</div>
<section class="job-detail section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12">
                <div class="content-area">
                    <div id="job-desc" class="">
                        <h4 class="title">Mô tả công việc</h4>
                        <div class="content-tab">
                            {!! $job->Job_Description !!}
                        </div>
                    </div>
                    <div id="job-desc" class="py-4">
                        <h4 class="title">Yêu cầu công việc</h4>
                        <div class="content-tab">
                            {!! $job->Job_Required !!}
                        </div>
                    </div>
                    <div id="job-interest" class="">
                        <h4 class="title">Quyền lợi công việc</h4>
                        <div class="content-tab">
                            {!! $job->Job_Interest !!}
                        </div>
                    </div>
                    <div id="job-way-apply" class="">
                        <h4 class="title">Cách thức ứng tuyển</h4>
                        Ứng viên nộp hồ sơ trực tuyến bằng cách bấm Ứng tuyển ngay dưới đây.
                        <div class="box-btn-action text-center my-2">
                            <a href="" class="btn-apply-jobs btn-common">Ứng tuyển</a><br>
                            @if($job->Job_Limit)
                                @if((strtotime($job->Job_Limit) - time())/86400>0)
                                    <span class="limit-apply">chưa đầy {{ ceil((strtotime($job->Job_Limit) - time())/86400) }} ngày để nộp hồ sơ</span>
                                @else
                                    <span class="limit-apply text-danger font-weight-bold">Đã hết hạn nộp hồ sơ</span>
                                @endif
                            @else
                                <span class="limit-apply">Không giới hạn</span>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-xs-12">
                <div class="sideber p-0">
                    <div class="widghet box-recruitment-info">
                        <div class="section-header m-0">
                            <h2 class="section-title">Thông tin tuyển dụng</h2>
                        </div>
                        <ul class="list-recruitment-info">
                            <li class="wage">
                                <span class="title">Mức lương:</span>
                                @php
                                    $wage="Thỏa thuận";
                                    if($job->Wage_From || $job->Wage_To){
                                        $wage=$job->Wage_From ? "Từ".currency($job->Wage_From) : " Đến ".currency($job->Wage_To);
                                    }
                                    if($job->Wage_From && $job->Wage_To){
                                        $wage="Từ ".currency($job->Wage_From)." Đến ".currency($job->Wage_To); 
                                    }
                                @endphp
                                <span class="content">@if(session("candidate")){{ $wage }}@else Bạn cần đăng nhập để xem @endif </span>
                            </li>
                            <li class="wage">
                                <span class="title">Hình thức làm việc:</span>
                                <span class="content">{{ $job->Job_Type_Title }}</span>
                            </li>
                            <li class="wage">
                                <span class="title">Số lượng cần tuyển:</span>
                                <span class="content">{{ $job->Number_People ?? "Không yêu cầu"}}</span>
                            </li>
                            <li class="wage">
                                <span class="title">Chức vụ:</span>
                                <span class="content">{{ $job->Job_Level_Title }}</span>
                            </li>
                            <li class="wage">
                                <span class="title">Yêu cầu kinh nghiệm:</span>
                                <span class="content">{{ $job->Job_Experience_Title ?? "Không yêu cầu" }}</span>
                            </li>
                            <li class="wage">
                                <span class="title">Yêu cầu giới tính:</span>
                                <span class="content">{{ "lỗi" }}</span>
                            </li>
                            <li class="wage">
                                <span class="title">Địa điểm làm việc:</span>
                                <span class="content">{{ $job->Province_Name }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="box-map widghet">
                        <h3>Nơi làm việc</h3>
                        <div class="maps">
                            <div id="map" class="map-full">
                                <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q={{ $job->Job_Address }}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widghet box-share">
                    <h3 class="title">Chia sẻ công việc</h3>
                    <div class="share-job">
                        <ul class="mt-4 footer-social">
                            <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                            <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<section id="featured" class="section bg-gray pb-45">
    <div class="container">
        <h4 class="small-title text-left">Công việc liên quan</h4>
        <div class="row">
            @foreach($jobSames as $item) 
            <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="job-featured">
                    <div class="icon">
                        <img src="{{ asset($item->Company_Logo) }}" alt="{{ $item->Job_Title }}">
                    </div>
                    <div class="content">
                        <h3><a href="{{ route("job.info",$item->Job_Slug) }}">{{ Str::limit($item->Job_Title,20) }}</a></h3>
                        <p class="brand">{{ $item->Company_Name }}</p>
                        <div class="tags">
                            <span><i class="lni-map-marker"></i>{{ $item->Province_Name }}</span>
                        </div>
                    </div>
                </div>
            </div>            
            @endforeach
        </div>
    </div>
</section>
@endsection

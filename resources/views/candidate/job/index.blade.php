@extends("candidate.master.index")
@section("title","Danh sách công việc đã lưu")
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route("home") }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Tìm kiếm việc làm</a></li>
        </ol>
    </nav>
    <div id="box-result" class="bg-white text-muted">
        <div class="row">
            <div class="col-md-7">
                <h4 class="title">Tìm việc làm mới nhất</h4>
            </div>
            <div class="col-md-3 col-6">
                <strong class="num-job-finded">{{ $jobs->total() }}</strong> Việc làm phù hợp
            </div>
            {{-- <div class="col-md-2 col-6">
                <strong class="num-job-save">10.00</strong> Việc làm đã lưu
            </div> --}}
        </div>
    </div>
    <div id="featured" class="row jobs-seached">
        <div class="col-md-8 box-job-finded">
            @foreach($jobs as $job)
            <div class="job-featured">
                <div class="icon">
                    <img src="{{ asset($job->Company_Logo) }}" alt="{{ $job->Job_Title }}">
                </div>
                <div class="content">
                    <h3><a href="{{ route("job.info",$job->Job_Slug) }}">{{ Str::limit($job->Job_Title,40) }}</a></h3>
                    <a href="{{ route("jobSave.option",$job->Job_ID) }}" class="btn-save-job"><i class="far fa-heart"></i></a>
                    <p class="brand">{{ $job->Company_Name }}</p>
                    <div class="tags">
                        <span><i class="lni-map-marker"></i>{{ $job->Province_Name }}</span>
                        @php
                            $wage="Thỏa thuận";
                            if($job->Wage_From || $job->Wage_To){
                                $wage=$job->Wage_From ? "Từ".currency($job->Wage_From) : " Đến ".currency($job->Wage_To);
                            }
                            if($job->Wage_From && $job->Wage_To){
                                $wage="Từ ".currency($job->Wage_From)." Đến ".currency($job->Wage_To); 
                            }
                        @endphp
                        <span><i class="far fa-money-bill-alt"></i>{{ $wage }}</span>
                        <span><i class="far fa-clock"></i></i>{{ date("Y-m-d",$job->Job_Created_At) }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $jobs->appends(["Job_Title"=>request("Job_Title"),"Specialize_ID"=>request("Specialize_ID"),"Province_ID"=>request("Province_ID"),"Experience"=>request("Experience"),"Job_Type"=>request("Job_Type")])->links() }}
        </div>
        <div id="advertisement-company-light" class="col-md-4 position-sticky py-2">
            <div class="box-advertisement">
                <a href="" class="box-thumbnail"><img src="https://static.topcv.vn/img/Banner%20Right%20FE%20Credit%20MT.jpg" class="company-banner" alt=""></a>
            </div>
        </div>
    </div>
</div>
@endsection

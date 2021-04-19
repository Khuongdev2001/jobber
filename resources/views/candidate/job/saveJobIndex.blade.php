@extends("candidate.master.index")
@section("title","Danh sách công việc đã lưu")
@section("css")
@endsection
@section("js")
{{-- add plugin sweetalert --}}
<script src="{{ asset("candidate/plugin/sweetalert/js/main.js") }}"></script>
<script>
    $(".btn-remove-job").click(function(e) {
    let url=$(this).attr("data-url");    
    Swal.fire({
        title: 'Xóa danh sách công việc',
        text: "Bạn có chắc muốn xóa!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'xóa'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href=url; 
        }
    })
})

</script>
@endsection
@section("content")
<div class="container">
    <div id="box-result" class="bg-white text-muted">
        <div class="row">
            <div class="col-md-12">
                <h4 class="title">Danh sách {{ $jobSaves->total() }} việc làm đã lưu</h4>
            </div>
        </div>
    </div>
    <div id="featured" class="row jobs-seached">
        <div class="col-md-8 box-job-finded">
            @foreach($jobSaves as $job)
            <div class="job-featured">
                <div class="icon">
                    <img src="{{asset($job->Company_Logo)}}" alt="{{ $job->Company_Name }}">
                </div>
                <div class="content">
                    <h3><a href="{{ route("job.info",$job->Job_Slug) }}" title="{{ $job->Job_Title }}">{{ Str::limit($job->Job_Title,50) }}</a></h3>
                    <span data-url="{{ route("jobSave.option",["id"=>$job->Job_ID,"status"=>0]) }}" class="btn-remove-job"><i class="far fa-trash-alt"></i></span>
                    <p class="brand">{{ $job->Company_Name }}</p>
                    <div class="tags">
                        @php
                            $wage="Thỏa thuận";
                            if($job->Wage_From || $job->Wage_To){
                                $wage=$job->Wage_From ? "Từ".currency($job->Wage_From) : " Đến ".currency($job->Wage_To);
                            }
                            if($job->Wage_From && $job->Wage_To){
                                $wage="Từ ".currency($job->Wage_From)." Đến ".currency($job->Wage_To); 
                            }
                        @endphp
                        <span><i class="lni-map-marker"></i>{{ $job->Name }}</span>
                        <span><i class="far fa-money-bill-alt"></i>{{ Str::limit($wage,20) }}</span>
                        <span><i class="far fa-clock"></i></i>{{ $job->Created_At }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $jobSaves->links() }}
        </div>
        <div id="advertisement-company-light" class="col-md-4 position-sticky py-2">
            <div class="box-advertisement">
                <a href="" class="box-thumbnail"><img src="https://static.topcv.vn/img/Banner%20Right%20FE%20Credit%20MT.jpg" class="company-banner" alt=""></a>
            </div>
        </div>

    </div>
</div>
@endsection

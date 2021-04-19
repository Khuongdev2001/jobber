{{-- include master --}}
@extends("employer.master.layout")
@section("title","Danh sách ứng viên phù hợp nhất")

@section("header")
    @include("employer.include.header")
@endsection
{{-- content --}}
@section("content")
<section class="space-ptb">
    <div class="container">
        <div class="section-title center">
            <h2 class="title">Danh sách ứng viên tiềm năng</h2>
        </div>
        <form action="" class="row">
            <div class="col-lg-3 mb-0">
                <div class="sidebar">
                    <div class="widget">
                        <div class="search">
                            <i class="fas fa-search"></i>
                            <input class="form-control" value="{{ request("search") }}" name="search" type="text" placeholder="Tìm kiếm ứng viên">
                        </div>
                    </div>                  
                    <div class="widget">
                        <div class="specialist">
                            <select class="form-control basic-select" name="Specialize">
                                <option value="">Chọn Ngành</option>
                                @foreach($specializes as $specialize)
                                    <option value="{{ $specialize->Specialize_ID }}" @if(request("Specialize")==$specialize->Specialize_ID) selected @endif>{{ $specialize->Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="Experience">
                            <select class="form-control basic-select" name="Experience">
                                <option value="">Chọn kinh nghiệm</option>
                                @foreach( __("user.Experience") as $key=>$item )
                                    <option value="{{ $key }}" @if(request("Experience")==$key) selected @endif >{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="locations">
                            <select class="form-control basic-select" name="Province">
                                <option value="">Chọn tỉnh</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->Province_ID }}" @if(request("Province")==$province->Province_ID) selected @endif>{{ $province->Province_Name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget-add">
                            <img class="img-fluid" src="images/add-banner.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="mb-0">Hiển <span class="text-primary">{{ $candidates->total() }} Ứng Viên</span></h6>
                    </div>
                </div>
                <div class="row">
                    @foreach($candidates as $candidate)
                        <div class="col-12">
                            <div class="candidate-list">
                                <div class="candidate-list-image">
                                    <img class="img-fluid" src="{{ asset($candidate->Avatar) }}" alt="{{ $candidate->Fullname }}">
                                </div>
                                <div class="candidate-list-details">
                                    <div class="candidate-list-info">
                                        <div class="candidate-list-title">
                                            <h5 class="mb-0"><a href="{{ route("employer.filter.candidate",$candidate->Candidate_ID) }}">{{ $candidate->Fullname }}</a></h5>
                                        </div>
                                        <div class="candidate-list-option">
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-filter pr-1"></i>Lĩnh vực làm việc:<span>{{ $candidate->Specialize_Name }}<span></li>
                                                <li><i class="fas fa-map-marker-alt pr-1"></i>làm việc tại: <span>{{ $candidate->Province_Name }}</span></li>
                                                @php
                                                $wage="Thỏa thuận";
                                                if($candidate->Wage_From || $candidate->Wage_To){
                                                    $wage=$candidate->Wage_From ? "Từ".currency($candidate->Wage_From) : " Đến ".currency($candidate->Wage_To);
                                                }
                                                if($candidate->Wage_From && $candidate->Wage_To){
                                                    $wage="Từ ".currency($candidate->Wage_From)." Đến ".currency($candidate->Wage_To); 
                                                }
                                                @endphp
                                                <li>Mức lương: <span>{{ $wage }}</span></li>
                                                <li>Kinh nghiệm: <span>1 năm</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="candidate-list-favourite-time">
                                    <a href="{{ route("employer.candidate.save.option",["id"=>$candidate->Candidate_ID,"status"=>1]) }}" class="candidate-list-favourite order-2" href="#"><i class="far fa-heart"></i></a>
                                </div>
                            </div>
                        </div>                                           
                    @endforeach    
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-4 mt-sm-5">
                        {{ $candidates->appends(["Specialize"=>request("Specialize"),"Province"=>request("Province"),"search"=>request("search"),"Experience"=>request("Experience")])->links() }}
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
{{-- include master --}}
@extends("employer.master.layout")
@section("title","Ứng viên {$candidate->Fullname}")
@section("header")
    @include("employer.include.header")
@endsection
{{-- content --}}
@section("content")
<div class="candidate-banner bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="candidate-list bg-light">
                    <div class="candidate-list-image">
                        <img class="img-fluid" src="{{ asset($candidate->Avatar) }}" alt="{{ $candidate->Fullname }}">
                    </div>
                    <div class="candidate-list-details">
                        <div class="candidate-list-info">
                            <div class="candidate-list-title">
                                <h5 class="mb-0">{{ $candidate->Fullname }}</h5>
                            </div>
                            <div class="candidate-list-option">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-filter pr-1"></i>Construction & Property</li>
                                    <li><i class="fas fa-map-marker-alt pr-1"></i>{{ $candidate->Province_Name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="widget ml-auto mb-0">
                        <div class="company-detail-meta ml-auto">
                            @if(empty($candidate->getCvDefault[0]->File))
                            <a class="btn btn-primary" href="javascript:void(0)">Chưa cập nhật cv</a>
                            @else
                            <a class="btn btn-primary" target="_back" href="{{ asset($candidate->getCvDefault[0]->File) }}">Xem cv<i class="fas fa-download ml-1"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="space-pb">
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-8 mb-4  mb-lg-0">
                <div class="jobber-candidate-detail">
                    <div id="about">
                        <h5 class="mb-3">Thông tin ứng viên</h5>
                        <div class="border p-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-file-signature"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Họ và tên:</label>
                                            <span class="d-block font-weight-bold text-dark">{{ $candidate->Fullname }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-mobile-alt"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Số điện thoại :</label>
                                            <span class="d-block font-weight-bold text-dark">Riêng tư</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center far fa-calendar-alt"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Ngày sinh :</label>
                                            <span class="d-block font-weight-bold text-dark">{{ $candidate->Birthday ?? "Chưa cập nhật" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-map-marker-alt"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Địa chỉ :</label>
                                            <span class="d-block font-weight-bold text-dark">{{ $candidate->Province_Name ?? "Chưa cập nhật" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-user-friends"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Giới tính :</label>
                                            <span class="d-block font-weight-bold text-dark">@if($candidate->Gender){{ __("user.Gender.{$candidate->Gender}") }}@else Chưa cập nhật @endif</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-briefcase"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Nghành làm việc :</label>
                                            <span class="d-block font-weight-bold text-dark">{{$candidate->Name ?? "Chưa cập nhật" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-flask"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">kinh nghiệm :</label>
                                            <span class="d-block font-weight-bold text-dark">@if($candidate->Experience){{ __("user.Experience.{$candidate->Experience}") }}@else Chưa cập nhật @endif</span>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $wage="Thỏa thuận";
                                    if($candidate->Wage_From || $candidate->Wage_To){
                                        $wage=$candidate->Wage_From ? "Từ".currency($candidate->Wage_From) : " Đến ".currency($candidate->Wage_To);
                                    }
                                    if($candidate->Wage_From && $candidate->Wage_To){
                                        $wage="Từ ".currency($candidate->Wage_From)." Đến ".currency($candidate->Wage_To); 
                                    }
                                @endphp
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center fas fa-money-bill"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Mức lương:</label>
                                            <span class="d-block font-weight-bold text-dark">{{ $wage }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex">
                                        <i class="font-xll text-primary align-self-center far fa-envelope-open"></i>
                                        <div class="feature-info-content pl-3">
                                            <label class="mb-0">Email:</label>
                                            <span class="d-block font-weight-bold text-dark">{{ $candidate->User_Email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mt-sm-5">
                           {{ $candidate->Description ?? "Chưa cập nhật" }}
                        </div>
                    </div>
                </div>
            </div>
            <!--=================================sidebar -->
            <div class="col-lg-4">
                <div class="sidebar mb-0">
                    <div class="widget">
                        <div class="widget-add">
                            <img class="img-fluid" src="https://static.topcv.vn/manual/co-viec-sieu-toc-cung-topcv.png" alt="">
                        </div>
                    </div>
                    <div class="widget pb-3">
                        <!-- gửi mail chỉ áp dụng với ứng viên trực tiếp ứng tuyển và có admin duyệt mới gửi mail dc  -->
                        <div class="widget">
                            <div class="widget-title">
                                <h5>Gửi mail ứng viên</h5>
                            </div>
                            <div class="company-contact-inner widget-box">
                                <form>
                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" rows="3" placeholder=""></textarea>
                                    </div>
                                    <a class="btn btn-primary btn-outline-primary btn-block" href="#">Send Email</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
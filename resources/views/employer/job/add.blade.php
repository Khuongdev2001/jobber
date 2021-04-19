@extends("employer.master.layout")
@section("title","Đăng tin tuyển dụng")
@section("css")
<link rel="stylesheet" href="http://themes.potenzaglobalsolutions.com/html/jobber/css/datetimepicker/datetimepicker.min.css">
{{-- select 2 plugin --}}
<link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
@endsection

@section("js")
<script src="https://cdn.tiny.cloud/1/vbzkm84qcbxrq5hsachp4rnckre9eor9ynuypftf4ue9e8g3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset("employer/plugins/jquery-appear/jquery.appear.js") }}"></script>
<script src="{{asset("employer/plugins/jquery-count-to/jquery.countTo.js")}}"></script>
{{-- select 2 --}}
<script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
<script src="http://themes.potenzaglobalsolutions.com/html/jobber/js/datetimepicker/moment.min.js"></script>
<script src="http://themes.potenzaglobalsolutions.com/html/jobber/js/datetimepicker/datetimepicker.min.js"></script>
<script>
    $('#Specialize_ID').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("employer.data.specialize") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {Name: params.term};
            },
            processResults: function (data, params) {
                return {results: $.map(data, function (item) {return {text: item.Name,id: item.Specialize_ID,data: item};})
                };
            }
        }
    });

    $('#Job_Province').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("employer.data.province") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {Province_Name: params.term};
            },
            processResults: function (data, params) {
                return {results: $.map(data, function (item) {return {text: item.Province_Name,id: item.Province_ID,data: item};})
                };
            }
        }
    });
    tinymce.init({
      selector: 'textarea',
      plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      toolbar_mode: 'floating',
   });
</script>
@endsection

@section("header")
    @include("employer.include.header")
@endsection

@section("content")
<div class="container">
    <div class="section-title center pt-5 pb-3">
        <h2 class="title">Thêm tin tuyển dụng mới</h2>
    </div>
    <div class="box-post-job-add">
        <form action="@if(empty($job)){{ route("employer.job.add") }}@else{{ route("employer.job.update",$job->Job_Slug) }}@endif" id="form-job-add" method="post">
            @csrf
            <div class="row">
                <!-- Job_Title  -->
                <div class="form-group col-md-6 @error("Job_Title") form-error @enderror">
                    <label for="Job_Title">Tiêu đề Công Việc:</label>
                    <input type="text" name="Job_Title" id="Job_Title" class="form-control" value="{{ old("Job_Title") ??  $job->Job_Title ?? "" }}">
                    @error("Job_Title")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end-Job_Title -->

                <!-- Specialize_ID  -->
                <div class="form-group col-md-6 @error("Specialize_ID") form-error @enderror">
                    <label for="Specialize_ID">Nghành nghề:</label>
                    <select name="Specialize_ID" class="form-control" id="Specialize_ID">
                        @if(!empty($job))
                            <option value="{{ $job->specialize->Specialize_ID }}">{{ $job->specialize->Name }}</option>
                        @endif
                    </select>
                    @error("Specialize_ID")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Specialize_ID -->
                
                <!-- Job_Type  -->
                <div class="form-group col-md-6">
                    <label for="Job_Type">Hình thức công việc:</label>
                    <select name="Job_Type" class="form-control basic-select @error("Job_Type") form-error @enderror" id="Job_Type">
                        @foreach(__("user.Job_Type") as $key => $item)
                            <option value="{{ $key }}" @if(!empty($job) && $key==$job->Job_Type) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error("Job_Type")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Job_Type -->

                <!-- Job_Level  -->
                <div class="form-group col-md-6">
                    <label for="Job_Level">Cấp bậc công việc:</label>
                    <select name="Job_Level" class="form-control @error("Job_Level") form-error @enderror basic-select" id="Job_Level">
                        @foreach(__("user.Job_Level") as $key=>$item)
                            <option value="{{ $key }}" @if(!empty($job) && $key==$job->Job_Level) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error("Job_Level")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Job_Level -->

                <!-- Number_People-  -->
                <div class="form-group col-md-6 @error("Number_People") form-error @enderror">
                    <label for="Number_People">Số lượng tuyển:</label>
                    <input type="text" name="Number_People" id="Number_People" class="form-control" value="{{ old("Number_People") ?? $job->Number_People ?? "" }}">
                    @error("Number_People")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Number_People -->

                <!-- Job_Experience  -->
                <div class="form-group col-md-6">
                    <label for="Job_Experience">Yêu cầu kinh nghiệm:</label>
                    <select name="Job_Experience" class="form-control @error("Job_Experience") form-error @enderror basic-select" id="Job_Experience">
                        @foreach( __("user.Experience") as $key => $item)
                            <option value="{{ $key }}" @if(!empty($job) && $job->Job_Experience==$key) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                    @error("Job_Experience")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Job_Experience -->

                <!-- Job_Province -->
                <div class="form-group col-md-6">
                    <label for="Job_Province">Tỉnh thành:</label>
                    <select name="Job_Province" class="form-control @error("Job_Province") form-error @enderror" id="Job_Province">
                        @if(!empty($job))
                            <option value="{{ $job->province->Province_ID }}">{{ $job->province->Province_Name }}</option>
                        @endif
                    </select>
                    @error("Job_Province")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Job_Province-->

                <!-- Job_Address  -->
                <div class="form-group col-md-6">
                    <label for="Job_Address">Địa chỉ làm việc:</label>
                    <input type="text" name="Job_Address" id="Job_Address" value="{{ old("Job_Address") ?? $job->Job_Address ??"" }}" class="form-control @error("Job_Address") form-error @enderror">
                    @error("Job_Address")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Job_Address -->

                <!-- Wage_From  -->
                <div class="form-group col-md-6">
                    <label for="Wage_From">Mức lương từ:</label>
                    <input type="text" name="Wage_From" id="Wage_From" value="{{ old("Wage_From") ?? $job->Wage_From ?? "" }}" class="form-control @error("Wage_From") form-error @enderror">
                    @error("Wage_From")
                        <span class="message">{{ $message }}</span>
                    @enderror    
                </div>
                <!-- Wage_From -->

                <!-- Wage_To  -->
                <div class="form-group col-md-6">
                    <label for="Wage_To">Mức lương đến:</label>
                    <input type="text" name="Wage_To" id="Wage_To" value="{{ old("Wage_To") ?? $job->Wage_To ?? "" }}" class="form-control @error("Wage_To") form-error @enderror">
                    @error("Wage_To")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Wage_To -->

                <!-- Job_Description -->
                <div class="form-group col-md-12 @error("Job_Description") form-error  @enderror">
                    <label for="Job_Description">Mô tả công việc: </label>
                    <textarea name="Job_Description" id="Job_Description" cols="30" rows="5" class="form-control">{{ old("Job_Description") ?? $job->Job_Description ?? "" }}</textarea>
                    @error("Job_Description")
                        <span class="message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- end-Job_Description -->

                <!-- Job_Interest  -->
                <div class="form-group col-md-12">
                    <label for="Job_Interest">Quyền lợi công việc: </label>
                    <textarea name="Job_Interest" id="Job_Interest" cols="30" rows="5" class="form-control @error("Job_Interest") form-error @enderror">{{ old("Job_Interest") ?? $job->Job_Interest ?? "" }}</textarea>
                    @error("Job_Interest")
                        <span class="message">{{ $message }}</span>
                    @enderror   
                </div>
                <!-- end Job_Interest -->

                <!-- Job_Required  -->
                <div class="form-group col-md-12">
                    <label for="Job_Required">Yêu cầu công việc: </label>
                    <textarea name="Job_Required" id="Job_Required" cols="30" rows="5" class="form-control @error("Job_Required") form-error @enderror">{{ old("Job_Required") ?? $job->Job_Required ?? "" }}</textarea>
                    @error("Job_Required")
                        <span class="message">{{ $message }}</span>
                    @enderror   
                </div>
                <!-- end job required -->
                

                <!-- Required_Gender -->
                <div class="form-group col-12">
                    <label for="">Yêu cầu giới tính: *</label>
                    @php
                        $checked=[];
                        $checked[$job->Required_Gender ?? ""]="checked";
                    @endphp
                    <div class="custom-control custom-checkbox d-flex">
                        <div class="check-male pr-5">
                            <input type="radio" name="Required_Gender" class="custom-control-input" {{ $checked[1] ?? "" }} value="1" id="male">
                            <label class="custom-control-label" for="male">Nam</label>
                        </div>
                        <div class="check-female pr-5">
                            <input type="radio" name="Required_Gender" class="custom-control-input" {{ $checked[2] ?? "" }} value="2" id="female">
                            <label class="custom-control-label" for="female">Nữ</label>
                        </div>
                        <div class="check-female">
                            <input type="radio" name="Required_Gender" class="custom-control-input" {{ $checked[0] ?? "checked" }} value="0" id="not-required">
                            <label class="custom-control-label" for="not-required">Không yêu</label>
                        </div>
                    </div>
                </div>
                <!-- end Required_Gender -->

                <!-- Job_Limit -->
                <div class="form-group col-md-6 datetimepickers">
                    <label>Hạn chót nộp hồ sơ: </label>
                    <div class="input-group date" id="datetimepicker-01" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" placeholder="Date" name="Job_Limit" data-target="#datetimepicker-01" value="{{ $job->Job_Limit ?? "" }}">
                        <div class="input-group-append" data-target="#datetimepicker-01" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                        </div>
                    </div>
                    <!-- end Job_Limit -->
                </div>

                <!-- btn post job -->
                <div class="form-group col-12">
                    @if(empty($job))
                        <a href="javascript:void(0)" class="btn btn-outline-success" data-toggle="modal" data-target=".modal-select-package">{{ count($servicePost) ? "Lưu và tiếp tục" :"Bạn cần mua gói để tiếp tục" }}</a>
                    @else
                        <button class="btn btn-success">Lưu</button>
                    @endif
                </div>
                <!-- end post job -->

                @if(empty($job))
                <!-- modal apply package -->
                <div class="modal fade modal-select-package" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Áp dụng gói với tin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Package_Post_Buy -->
                                <div class="form-group">
                                    <label for="Package_Post_Buy">Gói đăng tin: </label>
                                    <select name="Package_Post_Buy" class="form-control" id="Package_Post_Buy">
                                        <option value="">Chọn gói đăng tin</option>
                                        @foreach($servicePost as $service)
                                            <option value="{{ $service->Service_ID }}">{{ __("package.{$service->Package_ID}.Package_Name") }}({{ $service->Total }} Gói)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Package_Effect_Buy -->
                                <div class="form-group">
                                    <label for="Package_Effect_Buy">Gói hiệu ứng:</label>
                                    <select name="Package_Effect_Buy" class="form-control" id="Package_Effect_Buy">
                                        <option value="">Chọn gói hiệu ứng</option>
                                        @foreach($serviceEffect as $service)
                                            <option value="{{ $service->Service_ID }}">{{ __("package.{$service->Package_ID}.Package_Name") }}({{ $service->Total }} Gói)</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="box-note">
                                    <small class="note text-danger font-italic">
                                        Chú ý khi chọn gói hợp lý bạn sẽ mất gói đó, và tin tuyển dụng bạn sẽ phải xét duyệt mới có thể đăng. Nếu tin tuyển dụng không hợp lệ, gói sẽ được hoàn lại
                                    </small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success">Áp dung</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- end modal  -->
        </form>
    </div>
</div>

{{-- <div class="modal-more">
    <div class="modal-notification">
        <button class="btn-close btn"><i class="fas fa-times-circle"></i></button>
        <h5 class="title">Chú ý: </h5>
        <div class="content">
            <small class="font-weight-bold text-danger">Đây là quy định đăng tin</small>
            <br>
            <small class="font-weight-bold text-danger">Các tin tuyển dụng không được phép đăng do vi phạm yêu cầu của chúng tôi</small>
            <img class="img-fluid" src="public/img/2021-03-22 190428.png" alt="">
        </div>
    </div>
    <div class="dialog"></div> --}}
@endsection
@extends("admin.master.layout")
@section('title', empty($post) ? "Thêm bài viết" : $post->Post_Title)
@section('css')
    {{-- require css more --}}
    {{-- select 2 plugin --}}
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("admin/plugins/select2/css/select2-bootstrap4.css") }}">
    {{-- cropper image --}}
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset("admin/plugins/dropimage/css/main.css") }} ">
@endsection

@section('js')
    {{-- require js more --}}
    {{-- select 2 --}}
    <script src="{{ asset("admin/plugins/select2/js/select2.min.js") }}"></script>
    {{-- js cropper --}}
    <!-- plugin upload image avatar -->
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script src="{{ asset("admin/plugins/dropimage/js/main.js") }}"></script>
    <script>
     $(".btn-upload").click(function() {
		$("#upload-file").trigger("click");
	})
	// crop avatar 
	crop_image({
		id_preview: "preview_avatar",
		model_preview: "#modal-upload-avatar",
		btn_drop: "#crop_avatar",
		producted: ".thumbnail",
		preview_mini: "#modal-upload-avatar .preview_avatar_mini",
		input: "#upload-file",
	});

    $(".btn-add-tag").click(function() {
        $("#add-post.modal-more.add-tag form,#add-post.modal-more.add-tag h5").remove();
        $("#add-post.modal-more.add-tag").addClass("show");
        $("#add-post.modal-more.add-tag .modal-notification").append('<h5 class="title mb-2 text-dark">Thêm tag</h5><form action="{{ route("admin.post.tag.add") }}" method="POST"> @csrf <input type="hidden" name="continue" value="{{ route("admin.post.add") }}"> <div class="form-group"><label for="name">Tên tag</label><input type="text" id="name" name="Tag_Title" class="form-control" value=""></div><div class="form-group my-2"><button class="btn-hero btn-info-hero">Thêm</button></div></form>');
        return false;
    })

    $('#Cat_ID').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("admin.post.cat.searchselect2") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {
                    Cat_Title: params.term,
                };
            },
            processResults: function (data, params) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.Cat_Title,
                            id: item.Cat_ID,
                            data: item
                        };
                    })
                };
            }
        }
    });

    $('#Tag_ID').select2({
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("admin.post.tag.searchselect2") }}',
            type: 'GET',
            dataType: 'json',
            data: function (params) {
                return {
                    Tag_Title: params.term,
                };
            },
            processResults: function (data, params) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.Tag_Title,
                            id: item.Tag_ID,
                            data: item
                        };
                    })
                };
            }
        }
    });
    </script>
@endsection()

@section('sidebar')
@parent
@endsection

@section('header')
@parent
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Bài viết</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ empty($post) ? "Thêm Bài Viết" :"Cập Nhật Bài Viết" }}</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="box-option pb-3">
                    <button class="btn-hero btn-success-hero btn-add-tag" data-bs-toggle="tooltip" title="Thêm tag"><i class="fas fa-plus"></i></button>
                </div>
                <form action="{{ empty($post) ? route("admin.post.add") : route("admin.post.update",$post->Post_Slug) }}" method="post" class="py-3 form-add-post">
                    @csrf
                    <div class="row">
                        <!-- name -->
                        <div class="form-group col-md-4">
                            <label for="Post_Title" class="my-1">Tên bài viết:</label>
                            <input type="text" name="Post_Title" id="Post_Title" value="{{ old("Post_Title") ?? $post->Post_Title ?? "" }}" class="form-control">
                        </div>
                        <!-- end name -->

                        <!-- cat select 2 -->
                        <div class="form-group col-md-4 my-sm-2 my-md-0">
                            <label for="Cat_ID" class="form-label">Danh mục: </label>
                            <select name="Cat_ID" id="Cat_ID" class="form-control">
                                @if(!empty($post->Cat_ID))
                                    <option value="{{ $post->Cat_ID }}">{{ $post->catPost->Cat_Title }}</option>
                                @endif 
                            </select>
                        </div>
                        <!-- end cat -->

                        <!-- tag select 2 -->
                        <div class="form-group col-md-4">
                            <label for="tag" class="form-label">tag: </label>
                            <select id="Tag_ID" name="Tag_ID" class="form-control">
                                @if(!empty($post->Tag_ID))
                                    <option value="{{ $post->Tag_ID }}">{{ $post->tag->Tag_Title }}</option>
                                @endif 
                            </select>
                        </div>

                        <input type="hidden" name="continue" value="{{ route("admin.post") }}">

                        <!-- thumbnail -->
                        <div class="preview-thumbnail col-12 mt-4">
                            <label for="upload-file">Upload ảnh:</label>
                            <div class="text-center position-relative">
                                <a href="javascript:void(0)" class="btn-upload btn-hero btn-info-hero"><i class="fas fa-file-upload"></i></a>
                                <input type="file" name="" id="upload-file" class="d-none">
                                <input type="hidden" name="Thumbnail" value="{{ old("Thumbnail") }}" class="hidden_file">
                                <a href="" class="box-thumbnail">
                                    @if(empty($post->Thumbnail))
                                        <img src="{{ old("Thumbnail") }}" alt="" class="thumbnail">
                                    @else
                                        <img src="{{ asset($post->Thumbnail) }}" alt="" class="thumbnail">
                                    @endif
                                </a>
                            </div>
                        </div>
                        <!-- end thumbnail -->

                        <!-- end tag -->

                        <!-- desc -->
                        <div class="form-group col-12 my-2">
                            <label for="Post_Description">Mô tả: </label>
                            <textarea name="Post_Description" id="Post_Description" class="form-control" cols="30" rows="4">{{ old("Post_Description") ?? $post->Post_Description ?? "" }}</textarea>
                        </div>
                        <!-- end desc -->

                        <!-- content -->
                        <div class="form-group col-12 my-2">
                            <label for="Post_Content">Nội dung: </label>
                            <textarea name="Post_Content" id="Post_Content" class="form-control" cols="30" rows="4">{{ old("Post_Content") ?? $post->Post_Content ?? "" }}</textarea>
                        </div>
                        <!-- end content -->

                        <!-- form check -->
                        <div class="form-group">
                            <label for="type">Loại bài viết:</label>
                            <div class="d-flex my-2">
                                @php
                                    $check=["","checked"];
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input" name="Is_Highlight" {{ !empty($post->Is_Highlight) ? $check[$post->Is_Highlight] :"" }} type="checkbox" value="1" id="Is_Highlight">
                                    <label class="form-check-label" for="Is_Highlight">Nổi bậc</label>
                                </div>
                                <span class="mx-2"></span>
                                <div class="form-check">
                                    <input class="form-check-input" name="Is_New" {{ !empty($post->Is_New) ? $check[$post->Is_New] :"" }} type="checkbox" value="1" id="Is_New">
                                    <label class="form-check-label" for="Is_New">Mới nhất</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn-hero btn-info-hero">Đăng bài</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal more add-tag --}}
<div id="add-post" class="add-tag modal-more">
    <div class="modal-notification modal-lg text-dark">
        <button class="btn-exit btn"><i class="fas fa-times-circle"></i></button>
    </div>
    <div class="dialog"></div>
</div>
{{-- end modal add-tag --}}

<!-- modal upload file -->
<div class="modal fade" id="modal-upload-avatar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload ảnh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="preview_avatar" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview_avatar_mini">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="crop_avatar">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')@endsection

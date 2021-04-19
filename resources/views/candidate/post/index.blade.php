@extends("candidate.master.index")
@section("title","trang chủ bài viết")
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="post-index">
    <div class="container-xl">
        <div class="row">
            <div class="box-left col-md-8 box-type-post">
                <div class="post-new">
                    <div class="box-search-post">
                        <h4 class="title">
                            @if(request("search"))
                            <span class="keyword">{{ request("search") }}</span>
                            -
                            @endif
                            kết quả tìm kiếm
                        </h4>
                        <form action="" class="box-search position-relative">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" value="{{ request("search") }}" class="search">
                                <button class="btn-search">tìm kiếm</button>
                            </div>
                        </form>
                        <span class="lable">
                            Vui lòng tìm lại nếu chưa hài lòng
                        </span>
                    </div>
                    <ul class="box-list-post">
                        @foreach($posts as $post)
                        <li class="list-post">
                            <div class="row">
                                <a href="{{ route("post.info",$post->Post_Slug) }}" class="box-thumbnail col-4">
                                    <img class="thumbnail" src="{{ asset($post->Thumbnail) }}" alt="{{ $post->Post_Title }}">
                                </a>
                                <div class="info col-8">
                                    <h5 class="title">
                                        <a href="{{ route("post.info",$post->Post_Slug) }}">
                                            {{ Str::limit($post->Post_Title,40) }}
                                        </a>
                                    </h5>
                                    <span class="date-create">
                                        {{ date("Y-m-d",$post->Post_Created_At) }}
                                    </span>
                                    <p class="desc">
                                        {{ Str::limit($post->Post_Description,80) }}
                                    </p>
                                </div>
                            </div>    
                        </li>
                        @endforeach                        
                    </ul>
                    <div class="box-option text-center">
                        {{ $posts->appends(["search"=>request("search")])->links() }}
                    </div>
                </div>
                <div class="advertisement pb-3">
                    <a href="" class="box-thumbnail"><img src="https://blog.topcv.vn/wp-content/uploads/2021/02/NTMN-KINHTE-TOPCV-BANNER.jpg" class="thumbnail" alt=""></a>
                </div>
            </div>
            <div class="box-right col-md-4">
                <div class="advertisement">
                    <a href="" class="box-thumbnail">
                        <img class="thumbnail" src="https://blog.topcv.vn/wp-content/uploads/2020/02/Banner-blog-topcv-001.jpg" alt="">
                    </a>
                </div>
                <div class="advertisement p-3">
                    <a href="" class="box-thumbnail">
                        <img class="thumbnail" src="https://blog.topcv.vn/wp-content/uploads/2020/11/Job-TopCV-1080x1080px.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

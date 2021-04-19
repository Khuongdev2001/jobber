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
                <div class="advertisement">
                    <a href="" class="box-thumbnail"><img src="https://blog.topcv.vn/wp-content/uploads/2021/02/NTMN-KINHTE-TOPCV-BANNER.jpg" class="thumbnail" alt=""></a>
                </div>
                    <div class="post-hight-light">
                        <h4 class="title">Bài viết nổi bậc</h4>
                        <ul class="box-list-post row">
                            @foreach($postHighLights as $post)
                            <li class="list-post col-md-6">
                                <div class="row">
                                    <a href="{{ route("post.info",$post->Post_Slug) }}" class="box-thumbnail col-4">
                                        <img src="{{ asset($post->Thumbnail) }}" alt="{{ $post->Post_Title }}" class="thumbnail">
                                    </a>
                                    <div class="info col-8">
                                        <h5 class="title"> <a href="{{ route("post.info",$post->Post_Slug) }}">{{ Str::limit($post->Post_Title,60) }}</a></h5>
                                        <span class="date-created">
                                            {{ date("Y-m-d",$post->Post_Created_At) }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="box-option text-center pt-3">
                            <a href="{{ route("post",["hightlight"=>1]) }}" class="btn-css-other">Xem thêm</a>
                        </div>
                    </div>
                    <div class="post-set-cat">
                        <h5 class="title">
                            Sức Khỏe/Đời Sống
                        </h5>
                        <ul class="box-list-post row">
                            @foreach($postCats as $post)
                            <li class="list-post col-md-6">
                                <a href="{{ route("post.info",$post->Post_Slug) }}" class="box-thumbnail">
                                    <img src="{{ asset($post->Thumbnail) }}" style="width: 200px" alt="{{ $post->Post_Title }}" class="thumbnail">
                                </a>
                                <div class="info">
                                    <span class="date-create">{{ date("Y-m-d",$post->Post_Created_At) }}</span>
                                    <p class="desc">{{ Str::limit($post->Post_Description,80) }}</p>
                                </div>
                            </li>               
                            @endforeach             
                        </ul>
                        <div class="box-option text-center">
                            <a href="{{ route("post",["cat"=>14]) }}" class="btn-css-border-other">Xem thêm</a>
                        </div>
                    </div>
                <div class="post-new">
                    <h5 class="title">
                        Bài viết mới nhất
                    </h5>
                    <ul class="box-list-post">
                        @foreach($postNews as $post )
                        <li class="list-post">
                            <div class="row">
                                <a href="{{ route("post.info",$post->Post_Slug) }}" class="box-thumbnail col-4"><img class="thumbnail" src="{{ asset($post->Thumbnail) }}" alt="{{ $post->Post_Title }}"></a>
                                <div class="info col-8">
                                    <h5 class="title">
                                        <a href="{{ route("post.info",$post->Post_Slug) }}">
                                            {{ $post->Post_Title }}
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
                        <a href="{{ route("post",["new"=>1]) }}" class="btn-css-other">Xem thêm</a>
                    </div>
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

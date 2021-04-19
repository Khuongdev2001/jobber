@extends("candidate.master.index")
@section("title",$post->Post_Title)
@section("css")
@endsection
@section("js")
@endsection
@section("content")
<div class="banner post">
    <a href="" class="">
        <img src="https://www.topcv.vn/images/seo-heading-op1.png" class="thumbnail" alt="">
    </a>
</div>
<div class="container">
    <div class="row pb-3">
        <div class="col-md-8 box-left box-post-detail">
            <div class="box-option-top">
                <!-- like share hoặc tag -->
            </div>
            <div id="post-detail">
                <h2 class="title">{{ $post->Post_Title }}</h2>
                <div class="info">
                    <small class="creator">{{ $post->catPost->Cat_Title }}</small>
                    <span class="date-created float-right">{{ date("Y-m-d",$post->Post_Created_At) }}</span>
                </div>
                <div class="content">
                    {!! $post->Post_Content !!}
                </div>
            </div>
        </div>
        <div class="col-md-4 box-right box-post-same">
            <div class="box-top advertisement">
                <a href="">
                    <img src="https://www.topcv.vn/v3/images/tinh-luong-gross-net.jpg" class="thumbnail" alt="">
                </a>
            </div>
            <div class="box-body">
                <h5 class="title">Bài viết liên quan</h5>
                <ul id="list-post-same">
                    <li class="item">
                        <p class="title no-backgroup">Hướng dẫn cách viếc đơn xin việc chuẩn nhất mà bạn biết</p>
                    </li>
                    <li class="item">
                        <p class="title no-backgroup">Hướng dẫn cách viếc đơn xin việc chuẩn nhất mà bạn biết</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

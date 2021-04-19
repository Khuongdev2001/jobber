<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Model\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function home()
    {
        // có 3 loại: mới nhất sức khỏe nổi bật
        $selects = ["Post_Slug", "Post_Title", "Thumbnail", "Post_Description", "Post_Created_At"];
        $postHighLights = Post::select($selects)->where([["Is_Highlight", 1], ["Post_Status", 1]])->limit(10)->get();
        $postNews = Post::select($selects)->where([["Is_New", 1], ["Post_Status", 1]])->limit(10)->get();
        $postCats = Post::select($selects)->where([["Cat_ID", 14], ["Post_Status", 1]])->limit(10)->get();
        return view("candidate.post.home", compact("postHighLights", "postNews", "postCats"));
    }

    public function index(Request $request)
    {
        $where = "Post_Title LIKE '%{$request->search}%'";
        if ($request->hightlight) {
            $where .= " AND Is_Highlight = '1'";
        }
        if ($request->new) {
            $where .= " AND IS_New = 1";
        }
        if ($request->cat) {
            $where .= " AND Cat_ID = '{$request->cat}'";
        }
        $posts = Post::whereRaw($where)->paginate(10);
        return view("candidate.post.index", compact("posts"));
    }

    public function info($slug)
    {
        // get post by slug
        $post = Post::select("Post_Title", "Cat_ID", "Thumbnail", "Post_Description", "Post_Content", "Post_Created_At")->where([["Post_Slug", $slug], ["Post_Status", 1]])->first();
        if(!$post){
            abort(404);
        }
        return view("candidate.post.info", compact("post"));
    }
}

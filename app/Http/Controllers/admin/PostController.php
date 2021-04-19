<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\post\UpdateCatPostRequest;
use App\Http\Requests\admin\post\AddTagRequest;
use App\Http\Requests\admin\post\AddPostRequest;
use App\Http\Requests\admin\post\UpdatePostRequest;
use Yajra\DataTables\DataTables;
use App\Model\Post;
use App\Model\CatPost;
use App\Model\Tag;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function indexCat()
    {
        return view("admin.post.indexCat");
    }

    public function getIndexCat()
    {
        $catPosts = CatPost::get();
        return DataTables::of($catPosts)
            ->addColumn("check", function ($cat) {
                return
                    '<div class="form-check d-flex justify-content-center">
                        <input class="form-check-input" type="checkbox" value="" data-id="' . $cat->User_ID . '">
                    </div>';
            })
            ->editColumn("Cat_Created_At", function ($cat) {
                return date("Y-m-d", $cat->User_Created_At);
            })
            ->addColumn("action", function ($cat) {
                $convert = [
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="far fa-check-circle"></i>',
                        "title" => "Chọn làm Menu"
                    ],
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="far fa-times-circle"></i>',
                        "title" => "Bỏ Chọn Làm Menu"
                    ]
                ];
                return
                    ' <div class="box-option">
                    <a href="' . route("admin.post.set.menu", ["id" => $cat->Cat_ID, "continue" => route("admin.post.cat"), "status" => $cat->Is_Menu]) . '" class="btn-hero ' . $convert[$cat->Is_Menu]["class"] . ' shadow" data-bs-toggle="tooltip" title="' . $convert[$cat->Is_Menu]["title"] . '">' . $convert[$cat->Is_Menu]["icon"] . '</a>
                    <a href="' . route("admin.post.cat.update", $cat->Cat_ID) . '" class="btn-hero btn-info-hero shadow btn-update" title="' . $cat->Cat_Title . '"><i class="fas fa-pen"></i></a>
                    <a href="javascript:void(0)" data-url="' . route("admin.post.cat.delete", $cat->Cat_ID) . '" class="btn-hero btn-danger-hero shadow btn-delete" data-bs-toggle="tooltip" title="Xóa danh mục"><i class="fas fa-trash-alt"></i></a>
                </div>';
            })
            ->rawColumns(["action", "Avatar", "check", "Level"])
            ->make(true);
    }

    public function setMenu($id, Request $request)
    {
        $numberCat = CatPost::where("Is_Menu", 1)->count();
        if ($numberCat > 4 && !$request->status) {
            return redirect($request->continue)->with("error", ["title" => "Cảnh báo", "message" => "Chỉ được phép tạo 5 menu"]);
        }
        $message = ["Loại bỏ menu thành công", "Thêm danh mục thành menu thành công!"];
        // update
        CatPost::find($id)->update(["Is_Menu" => !$request->status]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => $message[!$request->status]]);
    }

    public function updateCat($id, UpdateCatPostRequest $request)
    {
        CatPost::find($id)->update(["Cat_Title" => $request->Cat_Title, "Cat_Slug" => Str::slug($request->Cat_Title)]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật thành công"]);
    }

    public function addCat(UpdateCatPostRequest $request)
    {
        CatPost::create(["Cat_Title" => $request->Cat_Title, "Cat_Slug" => Str::slug($request->Cat_Title), "Cat_Created_At" => time()]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Thêm thành công danh mục"]);
    }

    public function deleteCat($id)
    {
        CatPost::find($id)->delete();
        return redirect()->back()->with("success", ["title" => "Thông báo", "message" => "Xóa thành công danh mục"]);
    }

    public function searchSelect2Cat(Request $request)
    {
        $catPosts = CatPost::select(["Cat_ID", "Cat_Title"])->where("Cat_Title", "LIKE", "%{$request->Cat_Title}%")->get();
        return response()->json($catPosts);
    }

    public function searchSelect2Tag(Request $request)
    {
        $catPosts = Tag::select(["Tag_ID", "Tag_Title"])->where("Tag_Title", "LIKE", "%{$request->Tag_Title}%")->get();
        return response()->json($catPosts);
    }

    public function addPost()
    {
        return view("admin.post.add");
    }

    public function addTag(AddTagRequest $request)
    {
        Tag::create(["Tag_Title" => $request->Tag_Title, "Tag_Created_At" => time()]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Thêm tag thành công"]);
    }

    public function doAddPost(AddPostRequest $request)
    {
        $post = $request->validated();
        $dataImage = explode(",", $request->Thumbnail);
        $file = "admin/images/posts/" . time() . "_" . Str::slug($request->Post_Title) . ".jpg";
        file_put_contents("public/" . $file, base64_decode($dataImage[1]));
        $post["User_ID"] = session("admin.User_ID");
        $post["Thumbnail"] = $file;
        $post["Post_Created_At"] = time();
        $post["Post_Slug"] = Str::slug($request->Post_Title) . "_" . time();
        Post::create($post);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Thêm bài viết thành công!"]);
    }

    public function updatePost($slug)
    {
        $post = Post::where("Post_Slug", $slug)->first();
        return view("admin.post.add", compact("post"));
    }


    public function doUpdatePost($slug, UpdatePostRequest $request)
    {
        $postDatabase = Post::where("Post_Slug", $slug)->first();
        $postRequest = $request->validated();
        if ($request->Thumbnail && is_file("public/" . $postDatabase["Thumbnail"])) {
            unlink("public/" . $postDatabase["Thumbnail"]);
            $dataImage = explode(",", $request->Thumbnail);
            $file = "admin/images/posts/" . time() . "_" . Str::slug($request->Post_Title) . ".jpg";
            file_put_contents("public/" . $file, base64_decode($dataImage[1]));
            $postRequest["Thumbnail"] = $file;
        }
        $postRequest["Post_Slug"] = Str::slug($request->Post_Title) . "_" . time();
        Post::where(["Post_Slug" => $slug])->update($postRequest);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Cập nhật bài viết thành công!"]);
    }


    public function indexPost()
    {
        return view("admin.post.index");
    }

    public function getIndexPost()
    {
        $posts = Post::select(["Post_ID", "Cat_Title", "Post_Title", "Post_Slug", "Thumbnail", "Is_Highlight", "Is_New", "Post_Status", "Post_Created_At"])->leftJoin("cat_posts", "posts.Cat_ID", "=", "cat_posts.Cat_ID")->get();
        return
            DataTables::of($posts)
            ->editColumn("Check", function ($post) {
                return
                    '<div class="form-check d-flex justify-content-center">
                    <input class="form-check-input" type="checkbox" data-id="' . $post->Post_ID . '" id="flexCheckChecked">
                </div>';
            })
            ->editColumn("Thumbnail", function ($post) {
                return
                    ' <a href="" class="box-thumbnail">
                    <img class="thumbnail" src="' . asset($post->Thumbnail) . '">
                  </a>';
            })
            ->editColumn("Post_Created_At", function ($post) {
                return date($post->Post_Created_At);
            })
            ->editColumn("Post_Title", function ($post) {
                return Str::limit($post->Post_Title, 30);
            })
            ->addColumn("Post_Type", function ($post) {
                $postType = "";
                $postType .= $post->Is_Highlight ? '<span class="badge bg-info">Tin nổi bật</span><br>' : "";
                $postType .= $post->Is_New ? '<span class="badge bg-success">Tin mới nhất</span><br>' : "";
                return $postType;
            })
            ->editColumn("Post_Created_At", function ($post) {
                return date("Y-h-d", $post->Post_Created_At);
            })
            ->addColumn("Action", function ($post) {

                $convert = [
                    [
                        "class" => "btn-warning-hero",
                        "icon" => '<i class="fas fa-eye"></i>'
                    ],
                    [
                        "class" => "btn-success-hero",
                        "icon" => '<i class="fas fa-eye-slash"></i>'
                    ]
                ];

                return
                    '<div class="box-option">
                <a href="' . route("admin.post.hidden", ["id" => $post->Post_ID, "continue" => route("admin.post"), "status" => $post->Post_Status]) . '" class="btn-hero ' . $convert[$post->Post_Status]["class"] . ' shadow" data-bs-toggle="tooltip">' . $convert[$post->Post_Status]["icon"] . '</a>
                <a href="' . route("admin.post.update", ["slug" => $post->Post_Slug]) . '" class="btn-hero btn-info-hero shadow" data-bs-toggle="tooltip" title="Cập nhật tài khoản"><i class="fas fa-pen"></i></a>
                <a href="javascript:void(0)" data-url="' . route("admin.post.delete", ["ids" => $post->Post_ID, "continue" => route("admin.post")]) . '" class="btn-hero btn-danger-hero shadow btn-delete" data-bs-toggle="tooltip" title="Xóa tài khoản"><i class="fas fa-trash-alt"></i></a>           
                </div>';
            })
            ->rawColumns(["Action", "Thumbnail", "Check", "Post_Type"])
            ->make(true);
    }

    public function hiddenPost($id, Request $request)
    {
        // chỉ có admin level 6 mới làm được
        $message = ["Bài viết đã được ẩn", "Bài viết đã được mở"];
        Post::find($id)->update(["Post_Status" => !$request->status]);
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => $message[!$request->status]]);
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        $numFile = 0;
        foreach (explode(",", $ids) as $id) {
            // get user by id
            $post = Post::find($id);
            $numFile++;
            if (is_file("public/" . $post->Thumbnail)) {
                unlink("public/" . $post->Thumbnail);
            };
            $post->delete();
        };
        return redirect($request->continue)->with("success", ["title" => "Thông báo", "message" => "Đã xóa thành công {$numFile} bài viết "]);
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = "posts";
    public $primaryKey = "Post_ID";
    public $timestamps = false;
    public $fillable = ["User_ID", "Cat_ID", "Tag_ID", "Post_Title", "Post_Slug", "Thumbnail", "Post_Description", "Post_Content", "Is_Highlight", "Is_New", "Post_Status", "Post_Created_At"];
    public function catPost()
    {
        return $this->belongsTo("App\Model\CatPost", "Cat_ID");
    }

    public function tag()
    {
        return $this->belongsTo("App\Model\Tag", "Tag_ID");
    }
}

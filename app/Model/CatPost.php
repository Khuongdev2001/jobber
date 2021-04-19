<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CatPost extends Model
{
    public $table = "cat_posts";
    public $primaryKey = "Cat_ID";
    public $timestamps=false;
    public $fillable = ["Cat_ID", "User_ID", "Cat_Title", "Cat_Slug", "Cat_Parent", "Is_Menu", "Cat_Created_At", "Cat_Updated_At"];
}

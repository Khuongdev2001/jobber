<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostPackage extends Model
{
    const CREATED_AT = "Package_Created_At";
    const UPDATED_AT = "Package_Updated_At";
    public $table = "post_packages";
    public $primaryKey = "Package_ID";
    public $fillable = ["Package_ID", "Package_Name", "Package_Type", "Package_Price", "Date_Expired", "Package_Created_At", "Package_Updated_At"];
}

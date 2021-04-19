<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FitlterPackage extends Model
{
    const CREATED_AT = "Package_Created_At";
    const UPDATED_AT = "Package_Updated_At";
    public $table = "filter_packages";
    public $primaryKey = "Package_ID";
    public $fillable = ["Package_ID", "Package_Name", "Package_Value", "Package_Price", "Package_Created_At", "Package_Updated_At"];
}

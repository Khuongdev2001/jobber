<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    const CREATED_AT = "Package_Created_At";
    const UPDATED_AT = "Package_Updated_At";
    public $table = "packages";
    public $primaryKey = "Package_ID";
    public $fillable = ["Package_ID", "Package_Name", "Package_Type", "Package_Value", "Date_Expired", "Package_Created_At", "Package_Updated_At"];
}

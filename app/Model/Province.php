<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $table = "provinces";
    public $primaryKey = "Province_ID";
    public $timestamps = false;
    public $fillable = ["Province_ID", "Province_Name", "Province_Code", "Province_Created_At", "Province_Updated_At"];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Specialize extends Model
{
    public $table = "specializes";
    public $primaryKey = "Specialize_ID";
    public $timestamps = false;
    public $fillable = ["Specialize_ID","Name","Code","Specialize_Created_At","Specialize_Updated_At"];
}

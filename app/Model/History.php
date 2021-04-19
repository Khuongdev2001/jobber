<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    const CREATED_AT="History_Created_At";
    const UPDATED_AT="History_Updated_At";
    public $table = "historys";
    public $primaryKey = "History_ID";
    public $fillable = ["History_ID", "User_ID", "History_Type", "History_Content", "History_Created_At", "History_Updated_At"];
}

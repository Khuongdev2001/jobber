<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $table = "tags";
    public $primaryKey="Tag_ID";
    public $timestamps=false;
    public $fillable=["Tag_ID","Tag_Title","Tag_Created_At","Tag_Updated_At"];
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $table = "contacts";
    public $primaryKey = "Contact_ID";
    public $fillable=["Contact_ID","Phone","Type","User_ID","Is_Block","Created_At","Updated_At","Deleted_At"];
}

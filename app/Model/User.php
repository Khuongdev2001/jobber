<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;
    public $table = "users";
    public $primaryKey = "User_ID";
    public $timestamps = false;
    public $fillable = [
        "User_ID", "User_Email", "User_Password", "Token", "Fullname", "Avatar", "Gender", "Phone", "Birthday", "Level", "Type_Login", "Is_Block", "User_Active", "Re_Sendmail", "User_Created_At", "User_Updated_At"
    ];


    public function getAuthPassword()
    {
        return $this->User_Password;
    }

}

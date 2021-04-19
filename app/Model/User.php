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
    const CREATED_AT = "User_Created_At";
    const UPDATED_AT = "User_Updated_At";
    public $table = "users";
    public $primaryKey = "User_ID";
    public $fillable = [
        "User_ID", "User_Email", "User_Password", "Token", "Fullname", "Avatar", "Gender", "Phone", "Birthday", "Level", "Type_Login", "Is_Block", "User_Active", "Re_Sendmail", "User_Created_At", "User_Updated_At"
    ];


    public function getAuthPassword()
    {
        return $this->User_Password;
    }

    public static function updateSessionAdmin($id)
    {
        if ($id == session("admin.User_ID")) {
            session(["admin" => self::find($id)]);
        }
    }

    public static function updateSessionEmployer($userID = null)
    {
        $userID = $userID ? $userID : session("employer.User_ID");
        return session(["employer" => self::select(["users.User_ID", "User_Email", "Fullname", "Avatar", "employers.Employer_ID", "Gender"])->leftJoin("employers", "employers.User_ID", "=", "users.User_ID")->where("users.User_ID", $userID)->first()]);
    }

    public static function updateSessionCandidate($userID = null)
    {
        $userID = $userID ? $userID : session("candidate.User_ID");
        return session(["candidate" => self::select(["users.User_ID", "User_Email", "Fullname", "Avatar", "candidates.Candidate_ID as Candidate_ID", "Gender"])->leftJoin("candidates", "candidates.User_ID", "=", "users.User_ID")->where("users.User_ID", $userID)->first()]);
    }

    public static function findOrCreateUser($email)
    {
        $object = static::where("User_Email", $email)->first();
        return $object ? $object : new static;
    }

    public static function getStatic()
    {
        return self::selectRaw(" COUNT(IF(Level=1,1,null)) as Candidate, COUNT(IF(Level=2,1,null)) as Employer, COUNT(IF(Level=3 OR Level=4 OR Level=5 OR Level=6,1,null)) as Admin ")
            ->first();
    }
}

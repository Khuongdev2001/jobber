<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    const CREATED_AT = "Cv_Created_At";
    const UPDATED_AT = "Cv_Updated_At";
    public $table = "cvs";
    public $fillable = ["Cv_ID", "Cv_Title", "Candidate_ID", "File", "Is_Default", "Cv_Created_At", "Cv_Updated_At"];
    public $primaryKey = "Cv_ID";

    public static function getCvByID($id, $candidateID)
    {
        return self::select("Cv_ID","File")->where([["Cv_ID", $id], ["Candidate_ID", $candidateID]])->first();
    }

    public static function countCvDefaultByID($candidateID)
    {
        return self::where([["Candidate_ID", $candidateID], ["Is_Default", 1]])->count("Cv_ID");
    }
}

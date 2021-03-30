<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    public $table = "employers";
    public $primaryKey = "Employer_ID";
    public $timestamps = false;
    public $fillable = ["Employer_ID", "User_ID", "Regency", "Company_Name", "Company_Phone", "Company_Address", "Business_License", "Company_Provinces", "Company_Size", "Specialize_ID", "Company_Contactor", "Company_Email", "Company_Website", "Company_Description", "Company_Logo", "Company_Cover", "Company_Is_Confirm"];
    public function specialize()
    {
        return $this->hasOne("App\Model\Specialize", "Specialize_ID");
    }

    public function province()
    {
        return $this->hasOne("App\Model\Province", "Province_ID");
    }
}

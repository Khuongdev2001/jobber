<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/** đây là bảng chưa tổng giá trị hiệu lực của gói lọc hồ sơ của 1 cá nhân */

class Employer_Filter_Package extends Model
{
    const CREATED_AT = "Created_At";
    const UPDATED_AT = "Updated_At";
    public $table = "empolyer_filter_packages";
    public $primaryKey = "ID";
    public $fillable = ["ID", "Employer_ID", "Status", "Created_At", "Updated_At"];

    public static function createOrUpdate($employer_ID)
    {
        return self::where("Employer_ID", $employer_ID)->first() ?: new self;
    }
}

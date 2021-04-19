<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\EmployerPackage;
use Illuminate\Support\Facades\DB;

class CheckService implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public $object = array();

    /**
     * [
     *      "betweenTo",
     *      "betweenFrom",
     *      "field"
     * ]
     */ 
    public function __construct($object)
    {
        $this->object = $object;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $service = EmployerPackage::select(DB::raw("`ID`"))
            ->whereRaw("`{$this->object["field"]}` = {$value} AND `Status` = 1 AND `Total_Current` <> 0 AND `Package_ID` BETWEEN {$this->object["betweenTo"]} AND {$this->object["betweenFrom"]} AND Employer_ID = " . session("employer.Employer_ID"))
            ->first();
        if (!$service)
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lỗi hệ thống';
    }
}

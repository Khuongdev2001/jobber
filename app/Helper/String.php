<?php
use Illuminate\Support\Facades\Hash;

if (!function_exists("createToken")) {
    function createToken()
    {
        return "Jobber_" . Hash::make(time());
    }
}

if (!function_exists("createCodeProduct")) {

    function createCodeProduct()
    {
        return "Jobber_" . time();
    }
}

if (!function_exists("PasswordRandom")) {
    function PasswordRandom()
    {
        $convert = ["al", "A5", "b34", "B5", "c2", "D3", "F", "f", 1, 9];
        $hash = "";
        foreach (str_split(time()) as $item) {
            $hash .= $convert[$item];
        }
        return $hash;
    }
}



if (!function_exists("currency")) {
    function currency($number, $format = "VNĐ")
    {
        if (!$number) {
            return "...";
        }
        return number_format($number) . " " . $format;
    }
}



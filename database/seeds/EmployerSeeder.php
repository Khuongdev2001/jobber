<?php

use Illuminate\Database\Seeder;
use App\Model\Employer;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employer::insert([
            [
                "User_ID" => 17,
                "Regency" => 1,
                "Company_Name" => "Pi Tech",
                "Company_Phone" => "039418273",
                "Company_Address" => "15 Vườn Lài Tân Phú",
                "Company_Provinces" => 1,
                "Company_Size" => 1,
                "Specialize_ID" => 1,
                "Company_Contactor" => "Nguyễn Hữu Khương",
                "Company_Email" => "Shopthuy2001@gmail.com",
                "Company_Website" => "1221@gmail.com",
                "Company_Description" => "Đây là tên của tôi",
            ], 
            [
                "User_ID" => 18,
                "Regency" => 1,
                "Company_Name" => "Pi Tech",
                "Company_Phone" => "039418273",
                "Company_Address" => "15 Vườn Lài Tân Phú",
                "Company_Provinces" => 1,
                "Company_Size" => 1,
                "Specialize_ID" => 1,
                "Company_Contactor" => "Nguyễn Hữu Khương",
                "Company_Email" => "Shopthuy2001@gmail.com",
                "Company_Website" => "1221@gmail.com",
                "Company_Description" => "Đây là tên của tôi",
            ], 
            [
                "User_ID" => 19,
                "Regency" => 1,
                "Company_Name" => "Pi Tech",
                "Company_Phone" => "039418273",
                "Company_Address" => "15 Vườn Lài Tân Phú",
                "Company_Provinces" => 1,
                "Company_Size" => 1,
                "Specialize_ID" => 1,
                "Company_Contactor" => "Nguyễn Hữu Khương",
                "Company_Email" => "Shopthuy2001@gmail.com",
                "Company_Website" => "1221@gmail.com",
                "Company_Description" => "Đây là tên của tôi",
            ]
        ]);
    }
}

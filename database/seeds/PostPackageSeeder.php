<?php

use Illuminate\Database\Seeder;
use App\Model\PostPackage;

class PostPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostPackage::insert([
            [
                "Package_Name"=>"Đăng tin cơ bản:",
                "Package_Type"=>"1",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Khung việc làm mới nhất:",
                "Package_Type"=>"2",
                "Package_Price"=>"30000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Khung việc làm hấp dẫn:",
                "Package_Type"=>"3",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Khung việc làm tuyển dụng gấp:",
                "Package_Type"=>"4",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ]
            , [
                "Package_Name"=>"Khung việc làm lương cao:",
                "Package_Type"=>"5",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ]
            , [
                "Package_Name"=>"Khung việc làm cấp quản lý:",
                "Package_Type"=>"6",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Tiêu đề đỏ:",
                "Package_Type"=>"7",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Icon Hot:",
                "Package_Type"=>"8",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ],
            [
                "Package_Name"=>"Icon uy tín:",
                "Package_Type"=>"9",
                "Package_Price"=>"10000",
                "Date_Expired"=>"30",
            ]
            
        ]);
    }
}

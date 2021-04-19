<?php

use Illuminate\Database\Seeder;
use App\Model\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::insert([
            [
                "Province_Name" => "Thành Phố Hồ Chí Minh",
                "Province_Code" => "12",
                "Province_Created_At" => time()
            ],
            [
                "Province_Name" => "Bình Phước",
                "Province_Code" => "12",
                "Province_Created_At" => time()
            ]
        ]);
    }
}

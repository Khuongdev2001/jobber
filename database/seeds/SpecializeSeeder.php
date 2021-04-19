<?php

use Illuminate\Database\Seeder;
use App\Model\Specialize;

class SpecializeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specialize::insert([
            [
                "Name" => "Công nghệ thông tin",
                "Code" => "CNTT",
                "Specialize_Created_At" => time()
            ],
            [
                "Name" => "Bán hàng/ Kinh doanh",
                "Code" => "KD",
                "Specialize_Created_At" => time()
            ],
            [
                "Name" => "Báo chí/ Truyền hình",
                "Code" => "BC",
                "Specialize_Created_At" => time()
            ],
            [
                "Name" => "Bảo hiểm",
                "Code" => "BH",
                "Specialize_Created_At" => time()
            ]
        ]);
    }
}

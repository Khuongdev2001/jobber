<?php

use Illuminate\Database\Seeder;
use App\Model\FitlterPackage;

class FitlterPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FitlterPackage::create([
            "Package_Name"=>"Gói lọc hồ sơ",
            "Package_Value"=>"1000",
            "Package_Price"=>"232323"
        ]);
    }
}

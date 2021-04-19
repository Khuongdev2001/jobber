<?php

use Illuminate\Database\Seeder;
use App\Model\Candidate;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::insert([
            [
                "User_ID" => 14,
                "Specialize_ID" => 1,
                "Province_ID" => 1,
                "Address" => "31 Trịnh Đình Thảo",
                "Marriage" => 1,
                "Experience" => 1,
                "Wage_From" => "33434",
                "Wage_To" => "5343434",
                "Description"=>"Tôi là lập trình viên thực thụ"
            ],
            [
                "User_ID" => 15,
                "Specialize_ID" => 1,
                "Province_ID" => 1,
                "Address" => "31 Trịnh Đình Thảo",
                "Marriage" => 1,
                "Experience" => 1,
                "Wage_From" => "33434",
                "Wage_To" => "5343434",
                "Description"=>"Tôi là lập trình viên thực thụ"
            ]
            , [
                "User_ID" => 16,
                "Specialize_ID" => 1,
                "Province_ID" => 1,
                "Address" => "31 Trịnh Đình Thảo",
                "Marriage" => 1,
                "Experience" => 1,
                "Wage_From" => "33434",
                "Wage_To" => "5343434",
                "Description"=>"Tôi là lập trình viên thực thụ"
            ]
        ]);
    }
}

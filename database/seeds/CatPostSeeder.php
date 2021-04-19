<?php

use Illuminate\Database\Seeder;
use App\Model\CatPost;

class CatPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatPost::insert([
            [
                "Cat_Title" => "Kinh tế",
                "Cat_Slug" => "2232-dsfad",
            ],
            [
                "Cat_Title" => "Kinh tế2",
                "Cat_Slug" => "2232-dsfad",
            ], [
                "Cat_Title" => "Kinh tế3",
                "Cat_Slug" => "2232-dsfad",
            ]
        ]);
    }
}

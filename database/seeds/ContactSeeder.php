<?php

use Illuminate\Database\Seeder;
use App\Model\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::insert([
            [
                "Phone"=>"0394182551",
                "Type"=>1,                
            ],
            [
                "Phone"=>"93848343",
                "Type"=>2,                
            ],
            [
                "Phone"=>"3984398434",
                "Type"=>1,                
            ],
            [
                "Phone"=>"3493948",
                "Type"=>3,                
            ],
            
        ]);
    }
}

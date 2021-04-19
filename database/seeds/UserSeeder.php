<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::insert([
        //     [
        //         "User_Email" => "ungvien2@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 1,
        //         "Is_Block" => 0,
        //         "Fullname" => "Ứng Viên 2",
        //         "User_Created_At" => time()
        //     ],
        //     [
        //         "User_Email" => "ungvien3@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 1,
        //         "Is_Block" => 0,
        //         "Fullname" => "Ứng Viên 4",
        //         "User_Created_At" => time()
        //     ],  [
        //         "User_Email" => "ungvien5@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 1,
        //         "Is_Block" => 0,
        //         "Fullname" => "Ứng Viên 5",
        //         "User_Created_At" => time()
        //     ]
        // ]);

        // User::insert([
        //     [
        //         "User_Email" => "nhatuyendung1@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 2,
        //         "Is_Block" => 0,
        //         "Fullname" => "Nhà tuyển dụng 1",
        //         "User_Created_At" => time()
        //     ],
        //     [
        //         "User_Email" => "nhatuyendung2@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 2,
        //         "Is_Block" => 0,
        //         "Fullname" => "Nhà Tuyển dụng 2",
        //         "User_Created_At" => time()
        //     ],  [
        //         "User_Email" => "nhatuyendung3@gmail.com",
        //         "User_Password" => Hash::make("Khuongthuy2001"),
        //         "Level" => 2,
        //         "Is_Block" => 0,
        //         "Fullname" => "Nhà Tuyển Dụng 3",
        //         "User_Created_At" => time()
        //     ]
        // ]);
        User::create([
            "User_Email" => "khuongmy1@gmail.com",
            "User_Password" => Hash::make("Khuongthuy2001"),
            "Level" => 6
        ]);
    }
}

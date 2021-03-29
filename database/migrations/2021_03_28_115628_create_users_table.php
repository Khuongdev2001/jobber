<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("users", function (Blueprint $table) {
            $table->id("User_ID");
            $table->string("Email", 255);
            $table->string("Token", 255)->nullable();
            $table->string("Fullname", 255)->nullable();
            $table->string("Avatar", 255)->nullable();
            $table->integer("Gender")->nullable();
            $table->string("Phone", 255)->nullable();
            $table->timestamp("Birthday")->nullable();
            $table->integer("Level")->nullable();
            $table->integer("Type_Login")->nullable()->default(0);
            $table->boolean("Is_Block")->default(false)->nullable();
            $table->boolean("User_Active")->default(false)->nullable();
            $table->string("Re_Sendmail", 255)->nullable();
            // timestamp
            $table->string("User_Created_At", 255)->nullable();
            $table->string("User_Updated_At", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

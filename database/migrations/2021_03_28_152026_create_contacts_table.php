<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id("Contact_ID");
            $table->string("Phone", 255)->nullable();
            $table->integer("Type");
            $table->unsignedBigInteger("User_ID");
            $table->foreign("User_ID")->references("User_ID")->on("users")->onDelete("cascade");
            $table->string("Created_At",255)->nullable();
            $table->string("Updated_At",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

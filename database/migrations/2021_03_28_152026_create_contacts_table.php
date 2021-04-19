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
            $table->unsignedBigInteger("User_ID")->nullable();
            $table->foreign("User_ID")->references("User_ID")->on("users");
            $table->boolean("Is_Block")->nullable()->default(false);
            $table->date("Created_At")->nullable();
            $table->date("Updated_At")->nullable();
            $table->date("Deleted_At")->nullable();
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

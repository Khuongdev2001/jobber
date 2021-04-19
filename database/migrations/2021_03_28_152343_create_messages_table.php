<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id("Message_ID");
            $table->unsignedBigInteger("User_Send");
            $table->foreign("User_Send")->references("User_ID")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("User_Received");
            $table->foreign("User_Received")->references("User_ID")->on("users")->onDelete("cascade");
            $table->text("Content");
            $table->string("Message_Created_At",255)->nullable();
            $table->string("Message_Updated_At",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

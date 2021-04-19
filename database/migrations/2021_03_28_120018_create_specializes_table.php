<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecializesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("specializes", function (Blueprint $table) {
            $table->id("Specialize_ID");
            $table->string("Name", 255);
            $table->string("Code", 255);
            $table->timestamp("Specialize_Created_At")->nullable();
            $table->timestamp("Specialize_Updated_At")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specializes');
    }
}

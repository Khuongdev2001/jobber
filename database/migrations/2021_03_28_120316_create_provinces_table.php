<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("provinces", function (Blueprint $table) {
            $table->id("Province_ID");
            $table->string("Province_Name", 255)->nullable();
            $table->string("Province_Code", 255)->nullable();
            $table->string("Province_Created_At", 255)->nullable();
            $table->string("Province_Updated_At", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id("Package_ID");
            $table->string("Package_Name", 255);
            $table->integer("Package_Type");
            $table->string("Package_Value",255);
            $table->string("Date_Expired", 255)->nullable();
            $table->date("Package_Created_At")->nullable();
            $table->date("Package_Updated_At")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_packages');
    }
}

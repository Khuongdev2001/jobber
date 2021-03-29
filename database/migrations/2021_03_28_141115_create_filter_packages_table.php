<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_packages', function (Blueprint $table) {
            $table->id("Package_ID");
            $table->string("Package_Name", 255);
            $table->string("Package_Value",255);
            $table->string("Package_Price",255);
            $table->string("Package_Created_At",255)->nullable();
            $table->string("Package_Updated_At",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_packages');
    }
}

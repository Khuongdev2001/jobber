<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpolyerFilterPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empolyer_filter_packages', function (Blueprint $table) {
            $table->id("ID");
            $table->unsignedBigInteger("Employer_ID");
            $table->foreign("Employer_ID")->references("Employer_ID")->on("employers")->onDelete("cascade");
            $table->unsignedBigInteger("Package_ID");
            $table->foreign("Package_ID")->references("Package_ID")->on("filter_packages")->onDelete("cascade");
            $table->integer("Status")->nullable()->default(0);
            $table->string("Code_Active", 255)->nullable();
            $table->string("Code", 255)->nullable();
            $table->string("Buy_Created_At",255)->nullable();
            $table->string("Buy_Updated_At",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empolyer_filter_packages');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateEmployerPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employer_packages', function (Blueprint $table) {
            $table->id("ID");
            $table->unsignedBigInteger("Employer_ID");
            $table->foreign("Employer_ID")->references("Employer_ID")->on("employers");
            $table->unsignedBigInteger("Package_ID");
            $table->foreign("Package_ID")->references("Package_ID")->on("post_packages")->onDelete("cascade");
            $table->string("Total", 255)->nullable();
            $table->string("Total_Current", 255)->nullable();
            $table->string("Package_Price", 255)->nullable();
            $table->string("Total_Package_Price", 255)->nullable();
            $table->string("Code", 255)->nullable();
            $table->string("Code_Active")->nullable();
            $table->integer("Status")->nullable()->default(0);
            $table->date("Buy_Created_At")->nullable();
            $table->date("Buy_Updated_At")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_post_packages');
    }
}

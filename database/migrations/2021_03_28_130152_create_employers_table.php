<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id("Employer_ID");
            $table->unsignedBigInteger("User_ID");
            $table->foreign("User_ID")->references("User_ID")->on("users")->onDelete("cascade");
            $table->integer("Regency")->nullable();
            $table->string("Company_Name", 255)->nullable();
            $table->string("Company_Phone", 255)->nullable();
            $table->string("Company_Address", 255)->nullable();
            $table->string("Business_License", 255)->nullable();
            $table->unsignedBigInteger("Company_Provinces")->nullable();
            $table->foreign("Company_Provinces")->references("Province_ID")->on("provinces")->onDelete("cascade");
            $table->integer("Company_Size")->nullable();
            $table->unsignedBigInteger("Specialize_ID")->nullable();
            $table->foreign("Specialize_ID")->references("Specialize_ID")->on("specializes")->onDelete("cascade");
            $table->string("Company_Contactor", 255)->nullable();
            $table->string("Company_Email", 255)->nullable();
            $table->string("Company_Website", 255)->nullable();
            $table->text("Company_Description")->nullable();
            $table->string("Company_Logo", 255)->nullable();
            $table->string("Company_Cover", 255)->nullable();
            $table->boolean("Company_Is_Confirm")->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
}

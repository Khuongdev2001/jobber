<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id("Job_ID");
            $table->unsignedBigInteger("Employer_ID");
            $table->foreign("Employer_ID")->references("Employer_ID")->on("employers")->onDelete("cascade");
            $table->string("Job_Title", 255)->nullable();
            $table->unsignedBigInteger("Specialize_ID");
            $table->foreign("Specialize_ID")->references("Specialize_ID")->on("specializes")->onDelete("cascade");
            $table->integer("Job_Level")->nullable();
            $table->integer("Number_People")->nullable();
            $table->integer("Job_Experience")->nullable();
            $table->string("Wage_To")->nullable();
            $table->string("Wage_From")->nullable();
            $table->integer("Job_Type")->nullable();
            $table->text("Job_Description")->nullable();
            $table->text("Job_Required")->nullable();
            $table->integer("Required_Gender")->nullable();
            $table->string("Job_Limit", 255)->nullable();
            $table->unsignedBigInteger("Package_Post_Buy")->nullable();
            $table->foreign("Package_Post_Buy")->references("ID")->on("employer_post_packages")->onDelete("cascade");
            $table->unsignedBigInteger("Package_Effect_Buy")->nullable();
            $table->foreign("Package_Effect_Buy")->references("ID")->on("empolyer_filter_packages")->onDelete("cascade");
            $table->text("Job_Address");
            $table->unsignedBigInteger("Job_Province");
            $table->foreign("Job_Province")->references("Specialize_ID")->on("specializes")->onDelete("cascade");
            $table->integer("Job_Status")->nullable();
            $table->boolean("Job_Extend")->nullable()->default(false);
            $table->string("Package_Effect_Expire",255)->nullable();
            $table->string("Package_Post_Expire",255)->nullable();
            $table->string("Job_Created_At",255)->nullable();
            $table->string("Job_Updated_At",255)->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}

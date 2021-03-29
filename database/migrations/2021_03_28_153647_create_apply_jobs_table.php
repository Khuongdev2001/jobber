<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->id("ID");
            $table->unsignedBigInteger("Job_ID");
            $table->foreign("Job_ID")->references("Job_ID")->on("jobs")->onDelete("cascade");
            $table->integer("Apply_Status")->nullable();
            $table->unsignedBigInteger("Candidate_ID");
            $table->foreign("Candidate_ID")->references("Candidate_ID")->on("candidates")->onDelete("cascade");
            $table->string("Created_At",255)->nullable();
            $table->string("Updated_At",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply_jobs');
    }
}

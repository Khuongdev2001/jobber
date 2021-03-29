<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_saves', function (Blueprint $table) {
            $table->id("ID");
            $table->unsignedBigInteger("Candidate_ID");
            $table->foreign("Candidate_ID")->references("Candidate_ID")->on("candidates")->onDelete("cascade");
            $table->unsignedBigInteger("Job_ID");
            $table->foreign("Job_ID")->references("Job_ID")->on("jobs")->onDelete("cascade");
            $table->integer("Status")->nullable();
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
        Schema::dropIfExists('candidate_saves');
    }
}

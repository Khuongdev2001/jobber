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
            $table->unsignedBigInteger("Employer_ID");
            $table->foreign("Employer_ID")->references("Employer_ID")->on("employers")->onDelete("cascade");
            $table->integer("Status")->nullable();
            $table->timestamp("Created_At")->nullable();
            $table->timestamp("Updated_At")->nullable();
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

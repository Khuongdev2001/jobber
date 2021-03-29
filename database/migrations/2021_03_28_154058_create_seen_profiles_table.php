<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeenProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seen_profiles', function (Blueprint $table) {
            $table->id("ID");
            $table->unsignedBigInteger("Candidate_ID");
            $table->foreign("Candidate_ID")->references("Candidate_ID")->on("candidates")->onDelete("cascade");
            $table->unsignedBigInteger("Employer_ID");
            $table->foreign("Employer_ID")->references("Employer_ID")->on("employers")->onDelete("cascade");
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
        Schema::dropIfExists('seen_profiles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id("Candidate_ID");
            $table->unsignedBigInteger("User_ID");
            $table->foreign("User_ID")->references("User_ID")->on("users")->onDelete("cascade");
            $table->string("Cover", 255)->nullable();
            $table->unsignedBigInteger("Specialize_ID")->nullable();
            $table->foreign("Specialize_ID")->references("Specialize_ID")->on("specializes")->onDelete("cascade");
            $table->unsignedBigInteger("Province_ID")->nullable();
            $table->foreign("Province_ID")->references("Province_ID")->on("provinces")->onDelete("cascade");
            $table->boolean("Is_Notification_Job")->nullable()->default(false);
            $table->boolean("Is_Notification_Post")->nullable()->default(false);
            $table->text("Address")->nullable();
            $table->integer("Marriage")->nullable();
            $table->integer("Experience")->nullable();
            $table->string("Wage_From", 255)->nullable();
            $table->string("Wage_To", 255)->nullable();
            $table->boolean("Is_Hidden")->default(false)->nullable();
            $table->text("Description")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}

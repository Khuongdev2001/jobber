<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id("Post_ID");
            $table->unsignedBigInteger("User_ID");
            $table->foreign("User_ID")->references("User_ID")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("Cat_ID");
            $table->foreign("Cat_ID")->references("Cat_ID")->on("cat_posts")->onDelete("cascade");
            $table->unsignedBigInteger("Tag_ID");
            $table->foreign("Tag_ID")->references("Tag_ID")->on("tags")->onDelete("cascade");
            $table->string("Post_Title", 255);
            $table->string("Post_Slug", 255);
            $table->string("Thumbnail", 255)->nullable();
            $table->text("Post_Description", 255);
            $table->text("Post_Content", 255);
            $table->boolean("Is_Highlight")->default(false)->nullable();
            $table->boolean("Is_New")->default(false)->nullable();
            $table->string("Post_Created_At", 255)->nullable();
            $table->string("Post_Updated_At", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('video_id')->nullable();
            $table->string('channelId')->nullable();
            $table->string('title', 400)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnails')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('tags', 400)->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('views')->nullable();
            $table->integer('status')->nullable()->default(1);
            $table->integer('display')->nullable()->default(1);
            $table->text('note')->nullable();
            $table->string('embed_html', 400)->nullable();

            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}

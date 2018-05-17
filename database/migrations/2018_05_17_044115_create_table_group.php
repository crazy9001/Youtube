<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('slug', 120);
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users');
            $table->integer('parent_id')->unsigned()->default(0)->index();
            $table->string('note', 400);
            $table->string('icon');

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('slug', 120);
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users');
            $table->string('description', 400)->nullable()->default('');
            $table->tinyInteger('status')->unsigned()->default(1);

            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        Schema::create('group_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned()->index()->references('id')->on('tags')->onDelete('cascade');
            $table->integer('group_id')->unsigned()->index()->references('id')->on('groups')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('group_tag');
    }
}

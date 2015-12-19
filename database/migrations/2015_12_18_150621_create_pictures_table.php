<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('header', 50);
            $table->string('description')->nullable();
            $table->string('category', 50);
            $table->bigInteger('views')->unsigned();
            $table->bigInteger('likes')->unsigned();
            $table->bigInteger('dislikes')->unsigned();
            $table->boolean('flagged');
            $table->string('filename');
            $table->string('path', 510);
            $table->integer('size')->unsigned();
            $table->string('mime_type');
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
        Schema::drop('pictures');
    }
}

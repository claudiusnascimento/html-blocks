<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtmlBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('html_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('key')->nullable();
            $table->string('rel');
            $table->bigInteger('rel_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('content')->nullable();
            $table->boolean('active')->default(false)->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->string('image')->nullable();
            $table->string('layout')->nullable();
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
        Schema::dropIfExists('html_blocks');
    }
}

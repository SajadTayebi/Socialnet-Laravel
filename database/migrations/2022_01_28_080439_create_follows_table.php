<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('following_id');
            $table->unsignedBigInteger('followers_id');
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('followers_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['following_id', 'followers_id']);
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
        Schema::dropIfExists('follows');
    }
}

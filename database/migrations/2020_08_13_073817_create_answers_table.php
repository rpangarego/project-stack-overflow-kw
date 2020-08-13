<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('answer_id');
            $table->string('content');
            $table->bigInteger('vote_point');
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('profile_id')->on('profiles');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('question_id')->on('questions');

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
        Schema::dropIfExists('answers');
    }
}

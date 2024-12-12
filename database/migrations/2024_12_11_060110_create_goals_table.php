<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal_name');
            $table->text('goal_description')->nullable();
            $table->unsignedBigInteger('goal_created_by_user_id');
            $table->timestamps();

            $table->foreign('goal_created_by_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
}

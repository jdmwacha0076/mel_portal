<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivesTable extends Migration
{
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->string('objective_name');
            $table->text('objective_description')->nullable();
            $table->unsignedBigInteger('objective_created_by_user_id');
            $table->foreignId('goal_id')->constrained('goals')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('objective_created_by_user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('objectives');
    }
}

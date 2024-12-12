<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicatorsTable extends Migration
{
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->string('parent_type');
            $table->unsignedBigInteger('parent_id');
            $table->string('indicator_name');
            $table->string('target_value')->nullable();
            $table->string('achieved_value')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicators');
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_activities', function (Blueprint $table) {
            $table->id();
            $table->string('sub_activity_name');
            $table->text('sub_activity_description')->nullable();
            $table->foreignId('activity_id')->constrained('activities')->onDelete('cascade');
            $table->date('sub_activity_startdate');
            $table->date('sub_activity_end_date');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->decimal('budget', 15, 2)->nullable();
            $table->foreignId('assignee_id')->constrained('staff');
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('report_id')->nullable()->constrained('reports');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_activities');
    }
}

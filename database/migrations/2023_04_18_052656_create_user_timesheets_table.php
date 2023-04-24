<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_timesheets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timesheet_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('project_type_id')->nullable();
            $table->longText('task_details')->nullable();
            $table->string('task_status')->nullable();
            $table->string('task_hours')->nullable();
            $table->timestamps();

            $table->foreign('timesheet_id')->references('id')->on('timesheets')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_timesheets');
    }
};

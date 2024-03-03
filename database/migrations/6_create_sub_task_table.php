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
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('task_id')->constrained('tasks');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_complete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tasks');
    }
};

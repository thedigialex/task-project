<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->enum('status', ['todo', 'in_progress', 'completed']);
            $table->string('priority');
            $table->integer('hours_required');
            $table->string('flag')->nullable();
            $table->string('technological_level');
            $table->string('image_path')->nullable();
            $table->date('completion_expected_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

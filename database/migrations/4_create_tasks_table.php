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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('description');
            $table->string('status');
            $table->string('priority');
            $table->integer('hours_required');
            $table->string('technological_level');
            $table->string('image_path')->nullable();
            $table->date('target_date')->nullable();
            $table->foreignId('phase_id')->nullable()->constrained('phases');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};

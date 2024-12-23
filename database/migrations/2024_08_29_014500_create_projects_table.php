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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('projek')->nullable();
            $table->text('description')->nullable();
            $table->string('value')->nullable();
            $table->integer('progress')->nullable();  
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['planning', 'ongoing', 'completed', 'on_hold'])->default('planning');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
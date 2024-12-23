<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->enum('role',['Super_Admin','User'])->nullable();
            $table->string('email')->nullable();
            $table->string('namalengkap')->nullable();
            $table->date('ttl')->nullable();
            $table->enum('gender', ['Laki-laki', 'Perempuan'])->nullable();
            $table->bigInteger('notelp')->nullable();
            $table->enum('agama',['Islam', 'Kristen', 'Katolik', 'Buddha', 'Hindu', 'Konghucu'])->nullable();
            $table->date('joindate')->nullable();
            $table->date('enddate')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
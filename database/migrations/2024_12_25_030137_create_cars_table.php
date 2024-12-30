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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merk_id');
            $table->string('name');
            $table->string('nopol')->unique();
            $table->foreignId('transmission_id');
            $table->foreignId('fuel_id');
            $table->foreignId('type_id');
            $table->foreignId('passenger_id');
            $table->foreignId('owner_id');
            $table->string('color');
            $table->string('year');
            $table->string('image')->nullable();
            $table->string('interior')->nullable();
            $table->double('basic_price')->nullable();
            $table->double('rental_price')->nullable();
            $table->double('public_price')->nullable();
            $table->double('month_price')->nullable();
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};

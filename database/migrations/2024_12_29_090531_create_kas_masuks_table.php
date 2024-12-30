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
        Schema::create('kas_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('transaction_at');
            $table->string('item')->nullable();
            $table->integer('total');
            $table->enum('type', ['Penyewaan', 'Komisi', 'Ongkir', 'Uang Cuci', 'Klaim BBM', 'Klaim Kerusakan']);
            $table->date('rent_date')->nullable();
            $table->foreignId('input_by');
            $table->boolean('status')->default('1');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_masuks');
    }
};

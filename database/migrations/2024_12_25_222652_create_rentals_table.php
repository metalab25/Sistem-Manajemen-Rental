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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('inv_number')->unique();
            $table->enum('type', ['Lepas Kunci', 'Include', 'Check In', 'Check Out', 'Rent To Rent']);
            $table->string('marketing');
            $table->foreignId('customer_id');
            $table->foreignId('car_id');
            $table->date('tgl_start');
            $table->time('jam_start');
            $table->date('tgl_end');
            $table->time('jam_end');
            $table->integer('durasi');
            $table->integer('tarif');
            $table->integer('total')->nullable();
            $table->integer('dp')->nullable();
            $table->integer('balance')->nullable();
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default('1');
            $table->enum('pay_status', ['Lunas', 'Belum Lunas'])->default('Lunas');
            $table->foreignId('user_id');
            $table->foreignId('updated_by')->nullable();
            $table->date('closing_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};

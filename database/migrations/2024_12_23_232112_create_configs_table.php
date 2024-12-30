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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('inv_code')->default('LR/INV');
            $table->string('inv_start_number')->default('0001');
            $table->string('google_verification')->nullable();
            $table->string('timezone')->default('Asia/Jakarta');
            $table->string('web_title')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};

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
        Schema::create('konsultasi_pelaporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelaporan_id')->constrained('pelaporans')->onDelete('cascade');
            $table->dateTime('jadwal_konsultasi')->nullable();
            $table->enum('type_konsultasi', ['online', 'offline'])->default('online');
            $table->text('link_konsultasi')->nullable();
            $table->enum('status_konsultasi', ['pending', 'completed', 'canceled'])->default('pending');
            $table->foreignId('konsultan_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi_pelaporans');
    }
};

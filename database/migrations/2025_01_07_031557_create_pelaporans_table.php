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
        Schema::create('pelaporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('jenis_pelaporan');
            $table->string('nama_pelaku')->nullable();
            $table->string('jabatan_pelaku')->nullable();
            $table->string('lokasi');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('deskripsi');
            $table->text('data_pelaporan')->nullable();
            $table->string('file_laporan')->nullable();
            $table->string('status')->default('pending');
            // $table->json('follow_up_contact')->nullable();
            // $table->string('follow_up_contact_other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporans');
    }
};

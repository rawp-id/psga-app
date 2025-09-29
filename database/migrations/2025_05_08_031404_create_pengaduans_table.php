<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_pelaku')->nullable();
            $table->string('jabatan_pelaku')->nullable();
            $table->string('lokasi');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('deskripsi');
            $table->text('data_pengaduan')->nullable();
            $table->string('file_pengaduan')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

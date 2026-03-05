<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Run: php artisan make:migration create_educations_table
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->enum('category', ['artikel', 'video', 'pdf']);
            $table->text('content')->nullable(); // Untuk teks artikel
            $table->string('file_path')->nullable(); // Untuk path PDF atau URL YouTube
            $table->string('thumbnail')->nullable(); // Foto sampul konten
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};

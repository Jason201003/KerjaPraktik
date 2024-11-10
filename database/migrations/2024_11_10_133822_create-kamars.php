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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kamar'); // Contoh: 'Superior', 'Deluxe'
            $table->integer('kapasitas'); // Contoh: 2 atau 4
            $table->string('tipe_bed'); // Contoh: 'queen', 'king', 'twin'
            $table->decimal('harga', 8, 2)->nullable(); // Harga per malam, contoh: 150.00
            $table->text('fasilitas')->nullable(); // Contoh: "Wi-Fi, TV, AC"
            $table->text('deskripsi')->nullable(); // Deskripsi lengkap kamar
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};

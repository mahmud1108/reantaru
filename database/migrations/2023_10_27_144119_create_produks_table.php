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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('produk_nama', 100);
            $table->string('produk_slug', 100);
            $table->foreignId('kategori_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('produk_tanggal');
            $table->string('produk_harga', 10);
            $table->longText('produk_keterangan');
            $table->enum('produk_status', ['aktif', 'tidak aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

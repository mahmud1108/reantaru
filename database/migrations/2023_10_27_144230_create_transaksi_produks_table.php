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
        Schema::create('transaksi_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('produk_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaksi_produk_jumlah', 20);
            $table->string('transaksi_produk_harga', 20);
            $table->text('transaksi_produk_keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_produks');
    }
};

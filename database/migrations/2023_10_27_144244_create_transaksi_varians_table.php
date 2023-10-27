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
        Schema::create('transaksi_varians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_produk_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('varian_nama', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_varians');
    }
};

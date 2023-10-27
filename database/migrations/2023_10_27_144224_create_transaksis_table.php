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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->date('transaksi_tanggal');
            $table->dateTime('transaksi_waktu_pengiriman');
            $table->dateTime('transaksi_waktu');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('transaksi_nama', 50);
            $table->string('transaksi_hp', 15);
            $table->string('transaksi_email', 40);
            $table->text('transaksi_alamat');
            $table->string('transaksi_provinsi', 20);
            $table->string('transaksi_kabpuaten', 20);
            $table->string('transaksi_kurir', 15);
            $table->string('transaksi_ongkir', 20);
            $table->string('transaksi_total_bayar', 20);
            $table->enum('transaksi_status', ['Dibayar', 'Menunggu pembayaran', 'Gagal', 'Diterima', 'Pending']);
            $table->enum('transaksi_status_pengiriman', ['Dikemas', 'Dikirim', 'Diterima', 'Dibatalkan', 'Menunggu pembayaran']);
            $table->string('transaksi_token', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

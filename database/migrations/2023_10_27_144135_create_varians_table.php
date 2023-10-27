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
        Schema::create('varians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('varian_nama', 30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varians');
    }
};

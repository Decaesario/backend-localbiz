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
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')
              ->constrained('pesanan')
              ->cascadeOnDelete();

            $table->string('nama_kurir');

            $table->string('status_pengiriman');

            $table->dateTime('waktu_berangkat')->nullable();

            $table->dateTime('waktu_sampai')->nullable();

            $table->decimal('jumlah_setoran',10,2)->nullable();

            $table->string('bukti_setoran')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman');
    }
};

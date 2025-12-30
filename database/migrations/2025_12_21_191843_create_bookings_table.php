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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('id_booking');
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');
            $table->string('nama_pemesan');
            $table->string('nama_katalog');
            $table->date('tanggal_booking');
            $table->integer('jumlah');  
            $table->integer('total_biaya');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran')->default('Belum Lunas');
            $table->string('catatan')->nullable();;


            $table->timestamps();
            
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

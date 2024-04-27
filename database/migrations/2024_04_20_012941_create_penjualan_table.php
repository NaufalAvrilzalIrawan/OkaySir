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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('penjualanID');
            $table->bigInteger('userID')->unsigned();
            $table->foreign('userID')
                  ->references('userID')
                  ->on('user')
                  ->onDelete('cascade');
            $table->date('tanggal');
            $table->string('namaMember')->nullable();
            $table->decimal('total', 10)->nullable();
            $table->decimal('totalAkhir', 10)->nullable();
            $table->decimal('bayar', 10)->nullable();
            $table->decimal('kembalian', 10)->nullable();
            $table->string('status', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};

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
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id('detailID');
            $table->bigInteger('penjualanID')->unsigned();
            $table->foreign('penjualanID')
                  ->references('penjualanID')
                  ->on('penjualan')
                  ->onDelete('cascade');
            $table->bigInteger('produkID')->unsigned();
            $table->foreign('produkID')
                  ->references('produkID')
                  ->on('produk')
                  ->onDelete('cascade');
            $table->integer('jumlah')->unsigned();
            $table->decimal('subtotal', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualans');
    }
};

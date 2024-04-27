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
        Schema::create('log_stok', function (Blueprint $table) {
            $table->id('detailLog');
            $table->bigInteger('produkID')->unsigned();
            $table->foreign('produkID')
                  ->references('produkID')
                  ->on('produk')
                  ->onDelete('cascade');
            $table->integer('jumlah')->unsigned();
            $table->string('aksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER `stok_masuk` AFTER INSERT ON `produk`
            FOR EACH ROW BEGIN

            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (NEW.produkID, NEW.stok,"Masuk", NEW.created_at);
            
            END
        ');
        DB::unprepared('
            CREATE TRIGGER `stok_kurang` AFTER INSERT ON `detailpenjualan`
            FOR EACH ROW BEGIN
        
            UPDATE produk SET stok = stok - NEW.jumlah WHERE produkID = NEW.produkID;
            
            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (NEW.produkID,NEW.jumlah,"Keluar", NEW.created_at);
            
            END
        ');
        DB::unprepared('
            CREATE TRIGGER `stok_tambah` AFTER DELETE ON `detailpenjualan`
            FOR EACH ROW BEGIN
        
            UPDATE produk SET produk.stok = produk.stok + old.jumlah WHERE produk.produkID = old.produkID;
            
            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (OLD.produkID, OLD.jumlah,"Masuk", OLD.created_at);
            
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

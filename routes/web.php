<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/coba', function () {
    return view('layouts.main');
});

Route::middleware('guest')->group(function() {
Route::get('/login', function () {
    return view('Login');
})->name('login');
Route::post('/logging',[UserController::class, 'login']);
});

Route::get('/logout',[UserController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function() {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk produk
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/produk',[ProdukController::class, 'index'])->name('produk');
    Route::get('/produk{id}',[ProdukController::class, 'show']);
    Route::get('/produk/buat', function () {
        return view('produk.tambah');
    })->name('produk.buat');
    Route::post('/produk/tambah',[ProdukController::class, 'store']);
    Route::get('/produk/edit{id}',[ProdukController::class, 'edit']);
    Route::post('/produk/ubah{id}',[ProdukController::class, 'update']);
    Route::get('/produk/hapus{id}',[ProdukController::class, 'destroy']);
    Route::get('/produk/aktif{id}',[ProdukController::class, 'aktif']);
    Route::get('/produk/stok',[ProdukController::class, 'stok'])->name('stok');
    Route::post('/penjualan/stok/filter',[ProdukController::class, 'filter'])->name('stok.filter');

    
    
    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk member
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/member',[MemberController::class, 'index'])->name('member');
    Route::get('/member{id}',[MemberController::class, 'show']);
    Route::get('/member/buat', function () {
        return view('member.tambah');
    })->name('member.buat');
    Route::post('/member/tambah',[MemberController::class, 'store']);
    Route::get('/member/edit{id}',[MemberController::class, 'edit']);
    Route::post('/member/ubah{id}',[MemberController::class, 'update']);
    Route::get('/member/hapus{id}',[MemberController::class, 'destroy']);
    
    

    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk user
    |--------------------------------------------------------------------------
    |
    */
    Route::middleware('checkRole:1')->group(function() {
        Route::get('/user',[UserController::class, 'index'])->name('petugas');
        Route::get('/user{id}',[UserController::class, 'show']);
        Route::get('/user/buat', function () {
            return view('user.tambah');
        })->name('user.buat');
        Route::post('/user/tambah',[UserController::class, 'store']);
        Route::get('/user/edit{id}',[UserController::class, 'edit']);
        Route::post('/user/ubah{id}',[UserController::class, 'update']);
        Route::get('/user/hapus{id}',[UserController::class, 'destroy']);
        Route::get('/user/aktif{id}',[UserController::class, 'aktif']);
    });
    Route::get('/profil',[UserController::class, 'profil'])->name('profil');
    Route::post('/profil/ubah',[UserController::class, 'ubah'])->name('profil.ubah');



    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk member
    |--------------------------------------------------------------------------
    |
    */
    Route::middleware('checkRole:1')->group(function() {
        Route::get('/diskon',[DiskonController::class, 'index'])->name('diskon');
        Route::get('/diskon{id}',[DiskonController::class, 'show']);
        Route::get('/diskon/buat', function () {
            return view('diskon.tambah');
        })->name('diskon.buat');
        Route::post('/diskon/simpan',[DiskonController::class, 'store'])->name('diskon.simpan');
        Route::get('/diskon/edit{id}',[DiskonController::class, 'edit']);
        Route::post('/diskon/ubah{id}',[DiskonController::class, 'update']);
        Route::get('/diskon/hapus{id}',[DiskonController::class, 'destroy']);
        Route::get('/potong{total}',[DiskonController::class, 'diskon']);
    });



    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk penjualan
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/penjualan',[PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/transaksi',[PenjualanController::class, 'create'])->name('transaksi');
    Route::get('/struk{id}',[PenjualanController::class, 'show']);
    Route::get('/penjualan/buat', function () {
        return view('penjualan.tambah');
    });
    Route::post('/penjualan/tambah',[PenjualanController::class, 'store']);
    Route::post('/penjualan/filter',[PenjualanController::class, 'filter'])->name('penjualan.filter');
    Route::get('/penjualan/edit{id}',[PenjualanController::class, 'edit']);
    Route::post('/penjualan/selesai{id}',[PenjualanController::class, 'update']);
    Route::get('/penjualan/hapus{id}',[PenjualanController::class, 'destroy']);

    /*
    |
    |--------------------------------------------------------------------------
    | Route untuk detailpenjualan
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/detailpenjualan',[DetailPenjualanController::class, 'index'])->name('detailpenjualan');
    Route::get('/detailpenjualan{id}',[detailPenjualanController::class, 'show']);
    Route::get('/detailpenjualan/buat', function () {
        return view('detailpenjualan.tambah');
    });
    Route::post('/detailpenjualan/simpan',[detailPenjualanController::class, 'store']);
    Route::get('/detailpenjualan/edit{id}',[detailPenjualanController::class, 'edit']);
    Route::post('/detailpenjualan/ubah{id}',[detailPenjualanController::class, 'update']);
    Route::get('/detailpenjualan/hapus{id}',[detailPenjualanController::class, 'destroy']);
});

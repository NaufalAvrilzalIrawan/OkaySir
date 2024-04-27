<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[UserController::class, 'login']);

// Route untuk produk
Route::get('/produk',[ProdukController::class, 'index']);
Route::get('/produk{id}',[ProdukController::class, 'show']);
Route::get('/produk/buat', function () {
    return view('produk.tambah');
});
Route::post('/produk/tambah',[ProdukController::class, 'store']);
Route::get('/produk/ubah{id}',[ProdukController::class, 'edit']);
Route::post('/produk/ubah{id}',[ProdukController::class, 'update']);
Route::get('/produk/hapus{id}',[ProdukController::class, 'destroy']);

// Route untuk member
Route::get('/member',[MemberController::class, 'index']);
Route::get('/member{id}',[MemberController::class, 'show']);
Route::get('/member/buat', function () {
    return view('member.tambah');
});
Route::post('/member/tambah',[MemberController::class, 'store']);
Route::get('/member/ubah{id}',[MemberController::class, 'edit']);
Route::post('/member/ubah{id}',[MemberController::class, 'update']);
Route::get('/member/hapus{id}',[MemberController::class, 'destroy']);

// Route untuk member
Route::get('/user',[UserController::class, 'index']);
Route::get('/user{id}',[UserController::class, 'show']);
Route::get('/user/buat', function () {
    return view('user.tambah');
});
Route::post('/user/tambah',[UserController::class, 'store']);
Route::get('/user/ubah{id}',[UserController::class, 'edit']);
Route::post('/user/ubah{id}',[UserController::class, 'update']);
Route::get('/user/hapus{id}',[UserController::class, 'destroy']);
Route::post('/logout',[UserController::class, 'logout']);
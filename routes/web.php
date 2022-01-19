<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage');
});

Auth::routes();

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('kategori', KategoriController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('buku', BukuController::class);
// Route::resource('belanja', BelanjaController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/belanja', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/belanja/{id}', [App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/belanja/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detailBuku'])->name('transaksi.bukudetail');

    Route::get('/keranjang', [App\Http\Controllers\TransaksiController::class, 'indexKeranjang'])->name('transaksi.keranjang');
    Route::post('/keranjang', [App\Http\Controllers\TransaksiController::class, 'checkoutKeranjang'])->name('transaksi.checkout');
    Route::post('/keranjang/batal/{id}', [App\Http\Controllers\TransaksiController::class, 'batalKeranjang'])->name('transaksi.batal');

    Route::get('/riwayat', [App\Http\Controllers\TransaksiController::class, 'riwayatTransaksi'])->name('transaksi.riwayat');
    Route::get('/riwayat/detail/{id}', [App\Http\Controllers\TransaksiController::class, 'detailTransaksi'])->name('transaksi.detail');
    Route::post('/riwayat/status/{id}', [App\Http\Controllers\TransaksiController::class, 'ubahStatus'])->name('transaksi.status');
   
});


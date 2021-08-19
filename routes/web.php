<?php

use Illuminate\Support\Facades\Route;

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

// Auth
Route::get('/login', 'AuthController@index');
Route::post('/login', 'AuthController@login');
Route::get('/registration', 'AuthController@registrationPage');
Route::post('/registration', 'AuthController@registration');
Route::get('/logout', 'AuthController@logout');

// Transaksi
Route::get('/', 'TransaksiController@index');
Route::get('/beli/{id}', 'TransaksiController@pageBeli');
Route::post('/beli', 'TransaksiController@beli');
Route::get('/cart', 'TransaksiController@cart');
Route::get('/hapus-cart/{id}', 'TransaksiController@hapusCart');
Route::post('/checkout', 'TransaksiController@checkout');
Route::get('/invoice/{id}', 'TransaksiController@invoice');
Route::get('/pembayaran/{id}', 'TransaksiController@pembayaran');
Route::post('/pembayaran', 'TransaksiController@uploadBukti');
Route::get('/history', 'TransaksiController@history');
Route::post('/terima-pesanan', 'TransaksiController@terima');



// Apoteker
Route::get('/apoteker', 'ApotekerController@index');
Route::post('/kirim-pesanan', 'ApotekerController@kirim');
Route::get('/list-obat', 'ApotekerController@listObat');
Route::get('/detail-obat/{id}', 'ApotekerController@detailObat');
Route::post('/tambah-obat', 'ApotekerController@tambahObat');
Route::post('/update-obat', 'ApotekerController@updateObat');
Route::post('/hapus-obat', 'ApotekerController@hapusObat');




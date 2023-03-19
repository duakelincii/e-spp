<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::resource('/dashboard/data-siswa', 'SiswaController');
Route::resource('/dashboard/data-kelas', 'KelasController');
Route::resource('/dashboard/data-spp', 'SppController');
Route::resource('/dashboard/data-petugas', 'PetugasController');
Route::resource('/dashboard/pembayaran', 'PembayaranController')->middleware('auth','privilege:admin&petugas');
Route::resource('/dashboard/histori', 'HistoryController');

Route::get('/dashboard/laporan', 'LaporanController@index');
Route::get('/dashboard/laporan/create', 'LaporanController@create');

Route::get('/login/siswa', 'SiswaLoginController@siswaLogin');
Route::post('/login/siswa/proses', 'SiswaLoginController@login');
Route::get('/dashboard/siswa/histori', 'SiswaLoginController@index');
Route::get('/siswa/logout', 'SiswaLoginController@logout');

Route::post('/dashboard/pembayaran/search','PembayaranController@index')->name('filter.pembayaran');
Route::get('/dashboard/pembayaran/status/pembayaran/{id}','PembayaranController@status')->name('status.pembayaran');
Route::get('/dashboard/pembayaran/bayar/{id}','PembayaranController@createpayment')->name('bayar.pembayaran');
Route::post('/dashboard/pembayaran/bayar/simpan/{id}','PembayaranController@storepayment')->name('bayar.store');
Route::get('/dashboard/pembayaran/{id}/bayar','PembayaranController@bayar');
Route::post('/dashboard/pembayaran/{id}/simpan/pembayaran','PembayaranController@storebayar')->name('bayar');

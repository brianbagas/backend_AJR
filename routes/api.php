<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AsetController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\AuthDriverController;
use App\Http\Controllers\Api\AuthPegawaiController;
use App\Http\Controllers\Api\AuthCustomerController;
use App\Http\Controllers\Api\DetailJadwalController;
use App\Http\Controllers\Api\PemilikController;
use App\Http\Controllers\Api\TransaksiController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

//Route::post('customer','Api\CustomerController@store');
//Route::get('customer','Api\CustomerController@show');\

Route::controller(AuthCustomerController::class)->group(function(){
    Route::post('/customer/login', 'login');
});
Route::controller(AuthPegawaiController::class)->group(function(){
    Route::post('/pegawai/login', 'login');
});
Route::controller(AuthDriverController::class)->group(function(){
    Route::post('/driver/login', 'login');
});



//  Route::controller(CustomerController::class)->group(function () {
     
//      Route::post('/customer', 'store');
//      //Route::get('/customer/{id_customer}','show');
//      Route::delete('/customer/{id_customer}', 'destroy');
//      Route::post('/customer/{id_customer}', 'update');
//  });

Route::controller(PegawaiController::class)->middleware(['auth:api_pegawai', 'role.Admin'])->group(function () {
    Route::get('/pegawai', 'index');
    Route::post('/pegawai', 'store');
    Route::get('/pegawai/{id_pegawai}','show');
    Route::delete('/pegawai/{id_pegawai}', 'destroy');
    Route::post('/pegawai/{id_pegawai}', 'update');

});

Route::controller(PromoController::class)->middleware(['auth:api_pegawai', 'role.Manager'])->group(function () {
    Route::get('/manager/promo', 'index');
    Route::post('/promo', 'store');
    Route::get('/promo/{id_promo}','show');
    Route::delete('/promo/{id_promo}', 'destroy');
    Route::put('/promo/{id_promo}', 'update');

});

Route::controller(PromoController::class)->middleware('auth:api_customer')->group(function () {
    Route::get('/customer/promo', 'index');

});
Route::controller(PromoController::class)->group(function () {
    Route::get('/android/promo', 'index');

});

// Route::controller(DriverController::class)->group(function () {
//     Route::get('/driver', 'index');
//     Route::post('/driver', 'store');
//     Route::get('/driver/{id_driver}','show');
//     Route::delete('/driver/{id_driver}', 'destroy');
//     Route::put('/driver/{driver}', 'update');

// });




Route::controller(CustomerController::class)->middleware('auth:api_customer')->group(function(){
    Route::get('/customer', 'index');
    Route::get('/customer/{id_customer}','show');
    Route::delete('/customer/{id_customer}', 'destroy');
    Route::put('/customer/{id_customer}', 'update');
});

Route::controller(CustomerController::class)->middleware(['auth:api_pegawai', 'role.CS'])->group(function(){
    Route::get('/customer', 'index');
    //Route::get('/customer/{id_customer}','show');
    Route::put('/verifikasi/customer/{id_customer}', 'update');
});



Route::controller(CustomerController::class)->group(function(){
    Route::post('/register/customer','store');
   //Route::get('/customer','index');
});

Route::controller(AsetController::class)->middleware(['auth:api_pegawai', 'role.Admin'])->group(function () {
    Route::get('/aset', 'index');
    Route::post('/aset', 'store');
    Route::get('/aset/{id_aset}','show');
    Route::delete('/aset/{id_aset}', 'destroy');
    Route::put('/aset/{id_aset}', 'update');

});

Route::controller(DriverController::class)->middleware(['auth:api_pegawai', 'role.Admin'])->group(function () {
    Route::get('/driver', 'index');
    Route::post('/driver', 'store');
    Route::get('/driver/{id_driver}','show');
    Route::delete('/driver/{id_driver}', 'destroy');
    Route::post('/driver/{id_driver}', 'update');
});

Route::controller(DetailJadwalController::class)->middleware(['auth:api_pegawai', 'role.Manager'])->group(function(){

    Route::get('/detailjadwal', 'index');
    Route::post('/detailjadwal', 'store');
    Route::put('/detailjadwal/{id_jadwal}/{id_pegawai}', 'update');
    Route::delete('/detailjadwal/{id_jadwal}/{id_pegawai}', 'destroy');
});

Route::controller(PegawaiController::class)->middleware(['auth:api_pegawai', 'role.Manager'])->group(function () {
    Route::get('/jadwal/pegawai', 'index');
    Route::post('/jadwal/pegawai', 'store');
    Route::get('/jadwal/pegawai/{id_pegawai}','show');
    Route::delete('/jadwal/pegawai/{id_pegawai}', 'destroy');
    Route::post('/jadwal/pegawai/{id_pegawai}', 'update');

});

Route::controller(TransaksiController::class)->middleware('auth:api_customer')->group(function(){
    Route::get('/transaksi/customer','index');
    Route::post('/transaksi/customer/store','store');
    Route::get('/transaksi/customer/{id}','showByIdCus');
    Route::delete('/transaksi/customer/{id}','destroy');
    Route::put('/edit/transaksi/{id}','update');
});
Route::controller(TransaksiController::class)->middleware(['auth:api_pegawai', 'role.CS'])->group(function(){
    Route::get('/CS/riwayat','index');
    Route::put('/CS/transaksi/{id}','update');
});

Route::controller(DriverController::class)->middleware('auth:api_customer')->group(function () {
    Route::get('/transaksi/driver', 'index');
    Route::get('/transaksi/driver/{id_driver}','show');
});
Route::controller(AsetController::class)->middleware('auth:api_customer')->group(function () {
    Route::get('/transaksi/aset', 'index');
    Route::get('/transaksi/aset/{id_aset}','show');
    Route::get('/lalala','showByStatus');
    Route::get('/brosur/customer/{id}','showByIdBrosur');
});

Route::controller(AsetController::class)->middleware(['auth:api_pegawai', 'role.Manager'])->group(function () {
    Route::get('/manager/brosur/{id}','showByIdBrosur');
    Route::get('/manager/brosur', 'index');
    Route::post('/manager/brosur', 'store');
    Route::get('/brosur/{id_aset}','show');
    Route::delete('/brosur/{id_aset}', 'destroy');
    Route::put('/brosur/{id_aset}', 'update');
});


Route::controller(PemilikController::class)->middleware(['auth:api_pegawai', 'role.Admin'])->group(function(){
    Route::get('/pemilik/index', 'index');
    Route::get('/pemilik/show/{id}', 'show');
    Route::post('/pemilik/store/', 'store');
    Route::put('/pemilik/update/{id}', 'update');
    Route::delete('/pemilik/delete/{id}', 'destroy');
});

Route::controller(TransaksiController::class)->group(function(){
    Route::get('/mobile/transaksi','index');
    //Route::get('/mobile/transaksi/{id}','show');
    Route::get('/mobile/transaksi/{month}/{year}','showLaporanmobil');
    Route::get('/mobile/transaksi/Customer/{month}/{year}','showLaporanCus');
    Route::get('/mobile/transaksi/Driver/{month}/{year}','showLaporanDriv');
    Route::get('/mobile/transaksi/Performa/{month}/{year}','showLaporanPerforma');
    Route::get('/mobile/transaksi/Terbanyak/{month}/{year}','showLaporanCusTerbanyak');
});

Route::controller(AsetController::class)->group(function(){
    Route::get('/mobilebrosur/transaksi','index');
    Route::get('/mobilebrosur/transaksi/{id}','showByIdBrosur');
});




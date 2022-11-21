<?php
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\PaypalController;
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
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('welcome',[TransactionController::class,'show']);
Route::get('/search',[TransactionController::class,'search'])->name('search');

route::get('createpaypal',[PaypalController::class,'createpaypal'])->name('createpaypal');

route::get('processPaypal',[PaypalController::class,'processPaypal'])->name('processPaypal');

route::get('processSuccess',[PaypalController::class,'processSuccess'])->name('processSuccess');

route::get('processCancel',[PaypalController::class,'processCancel'])->name('processCancel');

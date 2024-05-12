<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

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


Route::post('/users', [UserController::class, 'store'])->name('user.create');

Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');


Route::middleware('auth')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('home');

    Route::get('/deposit', [TransactionController::class, 'showDeposits'])->name('deposit');
    Route::get('/deposit/create', [TransactionController::class, 'createDeposit'])->name('deposit.create');
    Route::post('/deposit/store', [TransactionController::class, 'storeDeposit'])->name('deposit.store');

    Route::get('/withdraw', [TransactionController::class, 'showWithdraws'])->name('withdraw');
    Route::get('/withdraw/create', [TransactionController::class, 'createWithdraw'])->name('withdraw.create');
    Route::post('/withdraw/store', [TransactionController::class, 'storeWithdraw'])->name('withdraw.store');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

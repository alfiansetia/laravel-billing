<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CompController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false
]);
Route::group(['middleware' => 'auth'], function () {

    Route::delete('/user', [UserController::class, 'destroy'])->name('user.destroy');
    Route::resource('user', UserController::class)->except('create', 'show', 'destroy');

    Route::delete('/bank', [BankController::class, 'destroy'])->name('bank.destroy');
    Route::resource('bank', BankController::class)->except('create', 'show', 'destroy');

    // Route::get('/roles', [RoleController::class, 'role']);
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');

    Route::get('/company', [CompController::class, 'index'])->name('comp.index');
    Route::post('/company', [CompController::class, 'update'])->name('comp.update');

    Route::group(['middleware' => ['role:admin|member']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [UserController::class, 'profileUpdate'])->name('user.profileUpdate');
    });
});

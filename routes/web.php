<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Settings\AccountController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Storage;

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
    return view('welcome');
});

Route::resources([
    'contacts' => ContactController::class,
    'companies' => CompanyController::class
]);

Auth::routes(['verify' => true]);

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

Route::get('settings/account', [AccountController::class, 'index']);

Route::get('settings/profile', [ProfileController::class, 'edit'])->name('settings.profile.edit');

Route::put('settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
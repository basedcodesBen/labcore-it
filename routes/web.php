<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

// Redirect to login if unauthenticated and then go to specific dashboards
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('pages.admin.dashboard');
    })->middleware('role:admin')->name('admin.dashboard');

    Route::get('/staff/dashboard', function () {
        return view('pages.staff.dashboard');
    })->middleware('role:staff')->name('staff.dashboard');

    Route::get('/dosen/dashboard', function () {
        return view('pages.dosen.dashboard');
    })->middleware('role:dosen')->name('dosen.dashboard');
});

// Profile route (for authenticated users)
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

// Logout route (for authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
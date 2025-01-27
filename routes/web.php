<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InventoryItemController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\RoomReservationController;
use App\Http\Controllers\DosenRoomReservationController;
use App\Http\Controllers\DosenInventoryReservationController;
use App\Http\Controllers\Staff\InventoryReservationController;
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


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    // User CRUD Routes (Resource Controller)
    Route::resource('users', UserController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('admin/inventory-items', InventoryItemController::class);
});

Route::prefix('staff')->middleware('auth')->name('staff.')->group(function () {
    // Staff can view all pending room reservations and approve/reject
    Route::get('room-reservations', [RoomReservationController::class, 'index'])->name('room-reservations.index');
    Route::post('room-reservations/{reservation}/approve', [RoomReservationController::class, 'approve'])->name('room-reservations.approve');
    Route::post('room-reservations/{reservation}/reject', [RoomReservationController::class, 'reject'])->name('room-reservations.reject');
});

Route::prefix('dosen')->middleware('auth')->name('dosen.')->group(function () {
    Route::get('room-reservations', [DosenRoomReservationController::class, 'index'])->name('room-reservations.index');
    Route::post('room-reservations', [DosenRoomReservationController::class, 'store'])->name('room-reservations.store');
    Route::get('inventory-reservations/create', [DosenInventoryReservationController::class, 'create'])->name('inventory-reservations.create');
    Route::post('inventory-reservations', [DosenInventoryReservationController::class, 'store'])->name('inventory-reservations.store');
});

Route::prefix('staff')->middleware('auth')->name('staff.')->group(function () {
    Route::get('inventory-reservations', [InventoryReservationController::class, 'index'])->name('inventory-reservations.index');
    Route::post('inventory-reservations/{reservationId}/approve', [InventoryReservationController::class, 'approve'])->name('inventory-reservations.approve');
    Route::post('inventory-reservations/{reservationId}/reject', [InventoryReservationController::class, 'reject'])->name('inventory-reservations.reject');
});

// Profile route (for authenticated users)
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

// Logout route (for authenticated users)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

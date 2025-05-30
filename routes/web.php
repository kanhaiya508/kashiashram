<?php

use App\Http\Controllers\AshramController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('web/room-bookings/confirm', [IndexController::class, 'confirm'])->name('web.room-bookings.confirm');
Route::post('web/room-bookings/confirm', [IndexController::class, 'storeFinal'])->name('web.room-bookings.confirm.store');
Route::get('/thankyou', [IndexController::class, 'thankyou'])->name('thankyou');



Route::post('room-bookings/remove-from-session', [RoomBookingController::class, 'removeFromSession'])->name('room-bookings.remove-from-session');
Route::post('room-bookings/add-to-session', [RoomBookingController::class, 'addToSession'])->name('room-bookings.add-to-session');


// update route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'ashrams' => AshramController::class,
        'rooms' => RoomController::class,

    ]);

    // Room Booking Routes
    Route::get('room-bookings', [RoomBookingController::class, 'index'])->name('room-bookings.index');
    Route::get('room-bookings/create', [RoomBookingController::class, 'create'])->name('room-bookings.create');
    Route::post('room-bookings/store', [RoomBookingController::class, 'store'])->name('room-bookings.store');

    Route::get('room-bookings/confirm', [RoomBookingController::class, 'confirm'])->name('room-bookings.confirm');
    Route::get('room-bookings/invoice/{booking}', [RoomBookingController::class, 'generateInvoice'])->name('room-bookings.invoice');

    Route::post('room-bookings/confirm', [RoomBookingController::class, 'storeFinal'])->name('room-bookings.confirm.store');


    Route::get('room-bookings/available-rooms', [RoomBookingController::class, 'availableRooms'])->name('room-bookings.available');

    Route::get('room-bookings/{id}/{status}', [RoomBookingController::class, 'status_update'])->name('room-bookings.status.update');


    Route::get('/room-calendar', [CalendarController::class, 'roomcalendar'])->name('room-calendar');


    // financialyears
    Route::patch('financialyears-update-status/{financialyears}', [FinancialYearController::class, 'updateStatus'])
        ->name('financialyears.update.status');


    // CKEditor Upload Route
    Route::post('ckeditor/upload', [DashboardController::class, 'upload'])
        ->name('ckeditor.upload');
});



require __DIR__ . '/auth.php';

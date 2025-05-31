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




Route::middleware('auth')->group(function () {



    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'ashrams' => AshramController::class,
        'rooms' => RoomController::class,

    ]);

    Route::prefix('room-bookings')->name('room-bookings.')->group(function () {
        Route::get('enquiry', [RoomBookingController::class, 'enquiry'])->name('enquiry');
        Route::get('', [RoomBookingController::class, 'index'])->name('index');
        Route::get('create', [RoomBookingController::class, 'create'])->name('create');
        Route::post('store', [RoomBookingController::class, 'store'])->name('store');

        Route::get('confirm', [RoomBookingController::class, 'confirm'])->name('confirm');
        Route::post('confirm', [RoomBookingController::class, 'storeFinal'])->name('confirm.store');

        Route::get('invoice/{booking}', [RoomBookingController::class, 'generateInvoice'])->name('invoice');
        Route::get('available-rooms', [RoomBookingController::class, 'availableRooms'])->name('available');


        Route::get('{id}/edit', [RoomBookingController::class, 'edit'])->name('edit');
        Route::put('{id}', [RoomBookingController::class, 'update'])->name('update');
        Route::delete('{id}', [RoomBookingController::class, 'destroy'])->name('destroy');

        Route::post('room-bookings/{bookingId}/add-room', [RoomBookingController::class, 'addRoomToBooking'])->name('add-room');
        Route::post('room-bookings/{bookingId}/remove-room', [RoomBookingController::class, 'removeRoomFromBooking'])->name('remove-room');

        Route::get('status-update/{id}/{status}', [RoomBookingController::class, 'status_update'])->name('status.update');
    });


    Route::get('/room-calendar', [CalendarController::class, 'roomcalendar'])->name('room-calendar');


    // financialyears
    Route::patch('financialyears-update-status/{financialyears}', [FinancialYearController::class, 'updateStatus'])
        ->name('financialyears.update.status');


    // CKEditor Upload Route
    Route::post('ckeditor/upload', [DashboardController::class, 'upload'])
        ->name('ckeditor.upload');
});



require __DIR__ . '/auth.php';

<?php

use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\Admin\AdminTourController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminScreeningController;
use App\Http\Controllers\Admin\AdminTransportController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/journey', function () {
    return view('home');
})->name('home');

Route::prefix('user')->group(function () {
    
    // Resource route for bookings
    Route::resource('booking', BookingController::class);
    Route::resource('event', EventController::class);
    Route::resource('route', RouteController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('tour', TourController::class);
    Route::resource('offer', OfferController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('transport', TransportController::class);
    Route::resource('screening', ScreeningController::class);

});
Route::prefix('admin')->group(function () {
    Route::resource('movies', AdminMovieController::class);
    Route::resource('tours', AdminTourController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('transports', AdminTransportController::class);
    Route::resource('screenings', AdminScreeningController::class);
});

// for  search function
Route::post('journey/search',[TransportController::class,'search'])->name('transport.search');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('contact', [AdminController::class, 'contact'])->name('contact');
    Route::get('about', [AdminController::class, 'about'])->name('about');
});

Route::get('dashboardPage',[UserController::class,'dashboardPage'])->name('dashboardPage')->middleware(ValidUser::class);
// to manage and add new admin
Route::get('admin/manage', [UserController::class, 'manageAdmins'])->name('admin.manage')->middleware(ValidUser::class);
Route::post('admin/assign-role', [UserController::class, 'assignRole'])->name('admin.assignRole')->middleware(ValidUser::class);

// register and save
Route::post('/registerSave', [UserController::class, 'register'])->name('registerSave');
Route::get('/register', [UserController::class, 'viewregister'])->name('register');
Route::post('loginMatch', [UserController::class, 'login'])->name('LoginMatch');
Route::get('login', [UserController::class, 'viewlog'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');


Route::view('card','card');
Route::view('view','view');
Route::get('user',[UserController::class,'index'])->name('user.index');

Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/payment/{booking_id}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/seats/manage/{id}/{type}', [SeatController::class, 'manageSeats'])->name('seats.manage');
    Route::post('/seats/update/{id}/{type}', [SeatController::class, 'updateSeats'])->name('seats.update');

    Route::resource('tickets',TicketController::class);
});
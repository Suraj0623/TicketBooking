<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
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
use App\Http\Controllers\ProfileController;

// Home and Welcome Routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::get('/journey', function () {
    return view('home');
})->name('home');

Route::get('/search',[UserController::class,'search'])->name('search');

Route::get('/search',[UserController::class,'search'])->name('search');


Route::view('about', 'about')->name('about');
Route::prefix('user')->group(function () {

    // Resource route for bookings
    Route::resource('booking', BookingController::class);
    Route::get('/seat/{seat}',[SeatController::class,'update'])->name('update');
    Route::resource('event', EventController::class);
    Route::resource('route', RouteController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('tour', TourController::class);
    Route::resource('offer', OfferController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('transport', TransportController::class);
    Route::resource('screening', ScreeningController::class);
    Route::resource('ticket', TicketController::class);
    Route::get('/ticket/validate/{ticket}', [TicketController::class, 'validateTicket'])->name('ticket.validate');
    Route::resource('profile', ProfileController::class);


});
Route::view('/view','view');
Route::prefix('profile')->group(function () {
    Route::get('/partner', [UserController::class, 'partner'])->name('partner');
});
Route::prefix('admin')->group(function () {
    Route::resource('movies', AdminMovieController::class);
    Route::resource('tours', AdminTourController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('transports', AdminTransportController::class);
    Route::resource('screenings', AdminScreeningController::class);
    Route::resource('bookings', BookingController::class);
    Route::patch('booking/{booking}/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('booking.updatePaymentStatus');
    Route::patch('/payments/accept/{payment_id}', [PaymentController::class, 'accept'])->name('payments.accept');
    Route::patch('/payments/reject/{payment_id}', [PaymentController::class, 'reject'])->name('payments.reject');
    Route::get('user',[UserController::class,'user'])->name('user');
});

// for  search function
Route::post('journey/search', [TransportController::class, 'search'])->name('transport.search');

Route::prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

Route::get('dashboardPage', [UserController::class, 'dashboardPage'])->name('dashboardPage')->middleware(ValidUser::class);
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


Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Contact Form Submission
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    // Example mail logic (you need to configure email settings in .env)
    Mail::raw($request->message, function ($mail) use ($request) {
        $mail->to('support@example.com')
            ->subject($request->subject)
            ->from($request->email, $request->name);
    });
    return back()->with('success', 'Your message has been sent successfully!');
})->name('contact.submit');

// User Authentication Routes
Route::get('/register', [UserController::class, 'viewregister'])->name('register');
Route::post('/registerSave', [UserController::class, 'register'])->name('registerSave');
Route::get('login', [UserController::class, 'viewlog'])->name('login');
Route::post('loginMatch', [UserController::class, 'login'])->name('LoginMatch');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// Admin Dashboard and Management Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboardPage', [UserController::class, 'dashboardPage'])->name('dashboardPage');
    Route::get('admin/manage', [UserController::class, 'manageAdmins'])->name('admin.manage');
    Route::post('admin/assign-role', [UserController::class, 'assignRole'])->name('admin.assignRole');
});

// Admin Resource Routes
Route::prefix('admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('movies', AdminMovieController::class);
    Route::resource('tours', AdminTourController::class);
    Route::resource('events', AdminEventController::class);
    Route::resource('transports', AdminTransportController::class);
    Route::resource('screenings', AdminScreeningController::class);
    Route::resource('bookings', BookingController::class);
    Route::patch('booking/{booking}/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('booking.updatePaymentStatus');

    Route::get('bookings', [BookingController::class, 'index'])->name('admin.bookings.index');


}); 

// User Resource Routes
Route::prefix('user')->group(function () {
    Route::resource('booking', BookingController::class);
    Route::resource('event', EventController::class);
    Route::resource('route', RouteController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('tour', TourController::class);
    Route::resource('offer', OfferController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('transport', TransportController::class);
    Route::resource('screening', ScreeningController::class);
    Route::resource('ticket', TicketController::class);
    Route::get('/ticket/validate/{ticket}', [TicketController::class, 'validateTicket'])->name('ticket.validate');
    Route::resource('profile', ProfileController::class);

    // New Route for Recommendations
    Route::get('/{user}/recommendations', [UserController::class, 'recommendations'])
        ->name('user.recommendations');
        // Route for listing users
    Route::get('/', [UserController::class, 'index'])->name('user.index');
});

// Search Functionality
Route::post('journey/search', [TransportController::class, 'search'])->name('transport.search');

// Auth Middleware Group
Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/{id}/accept', [BookingController::class, 'accept'])->name('booking.accept');
    Route::post('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');

    Route::get('/payment/{booking_id}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::get('/seats/manage/{id}/{type}', [SeatController::class, 'manageSeats'])->name('seats.manage');
    Route::post('/seats/update/{id}/{type}', [SeatController::class, 'updateSeats'])->name('seats.update');

    // Route::get('/user/ticket/{bookingId}', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/user/ticket/{bookingId}', [TicketController::class, 'show'])->name('user.ticket');
    
});

// Seat Management Routes
Route::get('/seats/{booking}', [SeatController::class, 'view'])->name('seats.view');
Route::post('/seats/assign', [SeatController::class, 'assignSeats'])->name('seats.assign');

// Update Booking Status
Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
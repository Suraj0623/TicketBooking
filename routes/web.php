<?php

use Illuminate\Http\Request;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SeatController, TourController, UserController, EventController, MovieController, OfferController, RouteController, TicketController, BookingController, PaymentController, ScreeningController, TransportController, ProfileController};
use App\Http\Controllers\Admin\{AdminController, AdminTourController, AdminEventController, AdminMovieController, AdminScreeningController, AdminTransportController};

// Home and Welcome Routes
Route::get('/', [UserController::class, 'index'])->name('welcome');
Route::view('/journey', 'home')->name('home');
Route::view('about', 'about')->name('about');
Route::view('/view', 'view');
Route::view('/faq', 'faq')->name('faq');
Route::view('/contact', 'contact')->name('contact');

// Search Functionality
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::post('journey/search', [TransportController::class, 'search'])->name('transport.search');
Route::get('tours/filter', [TourController::class, 'filterTours']);

// Contact Form Submission
Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
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

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('movies', AdminMovieController::class);
    Route::resource('tours', AdminTourController::class)->except(['show']);
    Route::resource('events', AdminEventController::class);
    Route::resource('transports', AdminTransportController::class);
    Route::resource('screenings', AdminScreeningController::class);
    Route::resource('bookings', BookingController::class);
    Route::get('/', [UserController::class, 'view'])->name('user.view');
    Route::patch('booking/{booking}/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('booking.updatePaymentStatus');
    Route::patch('/payments/accept/{payment_id}', [PaymentController::class, 'accept'])->name('payments.accept');
    Route::patch('/payments/reject/{payment_id}', [PaymentController::class, 'reject'])->name('payments.reject');
});
Route::get('seat/{seatableId}/{seatableType}',[SeatController::class,'index']);
// User Routes
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
    Route::resource('profile', ProfileController::class);


Route::put('/payment/{payment}/updateStatus', [PaymentController::class, 'updateStatus'])->name('payment.updateStatus');
    // Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    // Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/ticket/validate/{ticket}', [TicketController::class, 'validateTicket'])->name('ticket.validate');
    Route::get('/{user}/recommendations', [UserController::class, 'recommendations'])->name('user.recommendations');
});
Route::prefix('profile')->group(function () {
    Route::get('/partner', [UserController::class, 'partner'])->name('partner');
});
// Booking & Payment Routes
Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/{id}/accept', [BookingController::class, 'accept'])->name('booking.accept');
    Route::post('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    Route::get('/payment/{booking_id}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
    Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
});

// Seat Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/seats/manage/{id}/{type}', [SeatController::class, 'manageSeats'])->name('seats.manage');
    Route::post('/seats/update/{id}/{type}', [SeatController::class, 'updateSeats'])->name('seats.update');
    Route::get('/seats/{booking}', [SeatController::class, 'view'])->name('seats.view');
    Route::post('/seats/assign', [SeatController::class, 'assignSeats'])->name('seats.assign');
});

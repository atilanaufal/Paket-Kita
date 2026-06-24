<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrackingController;
require_once base_path('Helpers\TrackPaket.php');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::resource('main', TrackingController::class);
Route::resource('user', UserController::class);



Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('user.register');


Route::get('/user-edit/{id}', [PageController::class, 'editAcc'])->name('user.edit');
Route::put('/user-edit/{id}', [UserController::class, 'editAcc']);
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('logout', [UserController::class, 'logout']);

Route::delete('/{id}', [UserController::class, 'eraseAcc'])->name('user.erase');

Route::delete('/history/{id}', [TrackingController::class, 'eraseTrackData'])->name('erase.track');

// Route untuk riwayat setelah login
Route::get('/history', [PageController::class, 'history'])->name('history')->middleware('auth');


// Tampilkan halaman tracking untuk GET request
Route::get('/', [PageController::class, 'home'])->name('tracking');

// Proses form untuk POST request
Route::post('/', function (Request $request) {
    $awb = $request->input('awb');
    $courier = $request->input('courier');

    if (empty($awb) || empty($courier)) {
        return back()->withErrors(['message' => 'Please enter a valid AWB number and courier.']);
    }

    // Fetch data from API
    $trackingData = fetchTrackingInfo($awb, $courier);

    if (!isset($trackingData['data'])) {
        return back()->withErrors(['message' => 'Tracking data not found.']);
    }

    // Save to database
    app(TrackingController::class)->storeTrackData($trackingData['data']);

    // Return to the view with tracking data
   return view('main.tracking', compact('trackingData'));
});


Route::get('/history', [TrackingController::class, 'getTrackData'])->name('history');

Route::get('/history/track/{id}', [TrackingController::class, 'showTrackView'])->name('track-view');


Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/password-change', [UserController::class, 'password'])->name('user.password');
Route::get('/settings', [PageController::class, 'settings'])->name('settings');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/register', [PageController::class, 'register'])->name('register');

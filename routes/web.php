<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\Admin\AuthenticatedSessionController as AdminLogin;
use App\Http\Controllers\Auth\Customer\AuthenticatedSessionController as CustomerLogin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\OpenAIService;

// -------------------------------
// HOME
// -------------------------------
Route::get('/', function () {
    return view('welcome');
});

Route::get('/camera', function () {
    return view('camera');
});

// -------------------------------
// ADMIN
// -------------------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLogin::class, 'create'])
        ->name('login');
});

Route::prefix('customer')->name('cliente.')->group(function () {
    Route::get('/login', [CustomerLogin::class, 'create'])
        ->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:web'], function () {

  Route::get('/dashboard', function () {
    return view('admin.dashboard');
  })->middleware(['auth', 'verified'])->name('dashboard');

  Route::resource('usuarios', 'App\Http\Controllers\Admin\UserController', [
    'parameters' => [
      'usuarios' => 'user', 
    ],
    'names' => [
      'index' => 'users',
      'create' => 'users_create',
      'show' => 'users_edit',
      'store' => 'users_store',
      'destroy' => 'users_destroy',
    ]
  ]);

  Route::resource('customers', 'App\Http\Controllers\Admin\CustomerController', [
    'parameters' => [
      'customers' => 'customer', 
    ],
    'names' => [
      'index' => 'customers',
      'create' => 'customers_create',
      'show' => 'customers_edit',
      'store' => 'customers_store',
      'destroy' => 'customers_destroy',
    ]
  ]);

  Route::resource('tickets', 'App\Http\Controllers\Admin\TicketController', [
    'parameters' => [
      'tickets' => 'ticket', 
    ],
    'names' => [
      'index' => 'tickets',
      'create' => 'tickets_create',
      'show' => 'tickets_edit',
      'store' => 'tickets_store',
      'destroy' => 'tickets_destroy',
    ]
  ]);

  Route::resource('idiomas', 'App\Http\Controllers\Admin\LanguageController', [
    'parameters' => [
      'idiomas' => 'language', 
    ],
    'names' => [
      'index' => 'languages',
      'create' => 'languages_create',
      'show' => 'languages_edit',
      'store' => 'languages_store',
      'destroy' => 'languages_destroy',
    ]
  ]);
  
  Route::get('/camera', function () {
    return view('camera');
  })->name('camera');
});
// -------------------------------
// CUSTOMER
// -------------------------------
Route::group(['prefix' => 'cliente', 'middleware' => 'auth:customer'], function () {
  Route::get('/dashboard', function () {
    return view('customer.dashboard');
  })->name('cliente.dashboard');
});

// -------------------------------
// AUTH
// -------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::post('/extract-data', function (Request $request, OpenAIService $openai) {

    $imageBase64 = $request->input('image');

    if (!$imageBase64) {
        return response()->json([
            'success' => false,
            'message' => 'Imagen no recibida'
        ]);
    }

    $result = $openai->extractDataFromImage($imageBase64);

    return response()->json([
        'success' => true,
        'data' => $result
    ]);

});

require __DIR__.'/auth-admin.php';
require __DIR__.'/auth-customer.php';


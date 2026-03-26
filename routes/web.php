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
    return view('front.welcome');
})->name('welcome');

Route::get('/camera', function () {
    return view('front.camera');
})->name('camera');

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

  Route::post('/images', 'App\Http\Controllers\Admin\ImageController@store')->name('images_store');
  Route::get('/images/thumb/{filename}', 'App\Http\Controllers\Admin\ImageController@showThumb')->name('images_thumb');
  Route::delete('/images/{filename}', 'App\Http\Controllers\Admin\ImageController@destroy')->name('images_destroy');	

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

	Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController', [
    'parameters' => [
      'faqs' => 'faq', 
    ],
    'names' => [
      'index' => 'faqs',
      'create' => 'faqs_create',
      'show' => 'faqs_edit',
      'store' => 'faqs_store',
      'destroy' => 'faqs_destroy',
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

  Route::resource('testings', 'App\Http\Controllers\Admin\TestingController', [
    'parameters' => [
      'testings' => 'testing', 
    ],
    'names' => [
      'index' => 'testings',
      'create' => 'testings_create',
      'show' => 'testings_edit',
      'store' => 'testings_store',
      'destroy' => 'testings_destroy',
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

Route::get('/images/{entity}/{entityId}/{filename}', 'App\Http\Controllers\Front\ImageController@showImage')->name('image');
Route::post('/change-language', 'App\Http\Controllers\Front\LanguageController@changeLanguage')->name('change_language');
Route::get('/', function () {})->middleware('setlocale');
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

Route::get('/', function () {})->middleware('setLocale');

Route::post('/change-language', 'App\Http\Controllers\Front\LanguageController@changeLanguage')->name('change-language');

Route::group(['middleware' => 'sitemap'], function () {
  Route::get('/es', 'App\Http\Controllers\Front\HomeController@index')->name('es.home');
  Route::get('/en', 'App\Http\Controllers\Front\HomeController@index')->name('en.home');
	Route::get('/es/tickets', 'App\Http\Controllers\Front\TicketController@index')->name('es.tickets');
	Route::get('/en/tickets', 'App\Http\Controllers\Front\TicketController@index')->name('en.tickets');
  Route::get('/es/tickets/{title}', 'App\Http\Controllers\Front\TicketController@show')->name('es.ticket');
  Route::get('/en/tickets/{title}', 'App\Http\Controllers\Front\TicketController@show')->name('en.ticket');
});


require __DIR__.'/auth-admin.php';
require __DIR__.'/auth-customer.php';


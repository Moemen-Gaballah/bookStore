<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\PaymentProviderController;


// Route Payment checkout 
Route::get('/get-checkout-id/{price}', [PaymentProviderController::class, 'checkoutPaymentId']);
Route::get('/get-checkout-status', [PaymentProviderController::class, 'checkoutPaymentStatus']);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    // our routes to be protected will go in here
    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');
});


Route::middleware('api.admin')->group(function () {
    // our routes to be protected will go in here must Admin
});

// Auth Adminpanel
// Route::middleware('AuthAdminpanel')->group(function () {
    // our routes to be protected will go in here must Admin
	Route::apiResources(['/user' => UserController::class]);
	Route::get('userSearch', [UserController::class, 'search']);
	Route::apiResources(['/category' => CategoryController::class]);
	Route::get('allcategory', [CategoryController::class, 'getAll']);
	Route::post('/book/{id}', [BookController::class, 'update']); // done add request method post for dataFrom & file
	Route::apiResources(['/book' => BookController::class]);
	Route::get('bookSearch', [BookController::class, 'search']);
	Route::apiResources(['/comment' => CommentController::class]);



// });

// public routes
Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');






Route::get('categories/{id}', [CategoryController::class, 'show']); // for frontend page

// Page For USers
Route::get('/home', [HomeController::class, 'index']);

// Page For USers
Route::get('/getCategories', [HomeController::class, 'getCategories']);

// Page For get Product From Cart
Route::post('/getBookForCart', [HomeController::class, 'getBookForCart']);


// Route Payment checkout 
// Route::post('/get-checkout-id/{$price}', [PaymentProviderController::class, 'checkoutPaymentId']);

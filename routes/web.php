<?php

use Illuminate\Support\Facades\Route;

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
//
// Route::get('/', function () {
//     return view('layouts.cart');
// });
// Route::get('/', function () {
//     return view('layouts.category');
// });

Route::get('/', function () {
    return view('layouts.frontend');
});

// Route::get('/category', function () {
//     return view('layouts.frontend');
// });


Route::get('/dashboard', function () {
    return view('layouts.dashboard');
});

Route::get('/{path}', function () {
    return view('layouts.frontend');
})->where( 'path', '([A-z\d\-/_.]+)?' );

Route::get('/dashboard/{path}', function () {
    return view('layouts.dashboard');
})->where( 'path', '([A-z\d\-/_.]+)?' );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

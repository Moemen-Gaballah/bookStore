<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CommentController;

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

Route::apiResources(['/user' => UserController::class]);

Route::get('userSearch', [UserController::class, 'search']);

Route::apiResources(['/category' => CategoryController::class]);
Route::get('allcategory', [CategoryController::class, 'getAll']);

Route::apiResources(['/book' => BookController::class]);
Route::post('/book/{id}', [BookController::class, 'update']); // done add request method post for dataFrom & file

Route::get('bookSearch', [BookController::class, 'search']);

Route::apiResources(['/comment' => CommentController::class]);

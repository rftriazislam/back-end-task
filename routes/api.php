<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeleteController;
use App\Http\Controllers\Api\EditController;
use App\Http\Controllers\Api\GetController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::group(['prefix' => 'v1'], function () {
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/category', [PostController::class, 'store_category']);
    Route::get('/categories', [GetController::class, 'categories']);
    Route::post('/update-single-category', [UpdateController::class, 'update_single_category']);
    Route::delete('category/{id}',  [DeleteController::class, 'delete_category']);


    Route::post('/news', [PostController::class, 'store_news']);
    Route::get('/news-list', [GetController::class, 'news_list']);
    Route::post('/update-single-news', [UpdateController::class, 'update_single_news']);
    Route::delete('news/{id}',  [DeleteController::class, 'delete_news']);

});
Route::put('/single-news/{id}', [EditController::class, 'single_news']);

Route::put('/single-category/{id}', [EditController::class, 'single_category']);

});

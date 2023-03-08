<?php

use App\Http\Controllers\UsersControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostsController;


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

Route::get('/users', [UsersControllers::class, 'index']);
Route::get('/users/{id}', [UsersControllers::class, 'show']);

// Route::get('/posts', [PostsController::class, 'index']);
// Route::get('/posts/{id}', [PostsController::class, 'show']);

// Route::resource('/posts', PostsController::class)->only(['index', 'show']);

//ugnjezdene rute
// Route::get('/users/{id}/posts', [UserPostsController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get(
        '/profile',
        function (Request $request) {
            return auth()->user();
        }
    );

    Route::resource('posts', PostsController::class)->only(['update', 'store', 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::resource('posts', PostsController::class)->only(['index']);
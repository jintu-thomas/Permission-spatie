<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[App\Http\Controllers\UserController::class,'login']);
Route::middleware('auth:api')->post('/logout',[App\Http\Controllers\UserController::class,'logout']);



// Route::middleware('auth:api')->post('/SuperAdmin',[App\Http\Controllers\PermissionController::class,'SuperAdmin']);
// Route::middleware('auth:api')->post('/rolePermission',[App\Http\Controllers\PermissionController::class,'rolePermission']);


Route::group([
    'middleware'=>'auth:api'], function() {
        Route::post('/logout',[App\Http\Controllers\UserController::class,'logout']);
        Route::post('/create',[App\Http\Controllers\UserController::class,'registration']);
        Route::get('/show',[App\Http\Controllers\BlogController::class,'showUser']);
        Route::get('/blogs',[App\Http\Controllers\BlogController::class,'showBlogs']);
        Route::post('/bcreate',[App\Http\Controllers\BlogController::class,'CreateBlog']);
        Route::patch('bedit',[App\Http\Controllers\BlogController::class,'EditBlog']);
        Route::delete('/bdelete/{id}',[App\Http\Controllers\BlogController::class,'DeleteBlog']);
        Route::
    
    });
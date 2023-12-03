<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

Route::get('category/list',[AuthController::class,'CategoryList'])->middleware('auth:sanctum');


//post
Route::get('post/list',[PostController::class,'PostAllList']);
//SearchKey
Route::post('post/search',[PostController::class,'postSearch']);
//postDetails
Route::post('post/details',[PostController::class,'postDetails']);



//category
Route::get('allcategory',[CategoryController::class,'allCategory']);
//Category List
Route::post('category/list',[CategoryController::class,'CategoryList']);

//post view
Route::post('post/action',[ActionLogController::class,'ActionLog']);






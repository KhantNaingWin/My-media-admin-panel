<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect()->route('register');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //Admin
    Route::get('dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    //Admin List
    Route::get('admin/list',[ListController::class,'adminList'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'adminDelete'])->name('admin#delete');
    Route::post('admin/list',[ListController::class,'adminSearchList'])->name('admin#searchlist');
    //Category
    Route::get('category',[CategoryController::class,'category'])->name('category');
    Route::post('category/Create',[CategoryController::class,'categoryCreate'])->name('category#create');
    Route::get('category/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category#delete');
    Route::post('category/search',[CategoryController::class,'CategorySearch'])->name('category#search');
    Route::get('category/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category#edit');
    Route::post('category/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('category#update');
    //Post
    Route::get('post',[PostController::class,'post'])->name('post');
    Route::post('post/create',[PostController::class,'PostCreate'])->name('post#create');
    Route::get('post/delete/{id}',[PostController::class,'PostDelete'])->name('post#delete');
    Route::get('post/updatePage/{id}',[PostController::class,'PostUpdatePage'])->name('post#updatepage');
    Route::post('post/update/{id}',[PostController::class,'UpdatePost'])->name('post#update');
    //trend post
    Route::get('trend/post',[TrendPostController::class,'trendPost'])->name('trend#post');
    Route::get('trend/details/{id}',[TrendPostController::class,'trendPostDetails'])->name('trend#postDeails');
    //Admin update
    Route::post('admin/update',[ProfileController::class,'adminUpdate'])->name('admin#update');
    //Direct Change Password
    Route::get('admin/changePassword',[ProfileController::class,'directChangePassword'])->name('admin#directChangePassword');
    //Change Password
    Route::post('admin/changePassword',[ProfileController::class,'adminChangePassword'])->name('admin#changePassword');
});

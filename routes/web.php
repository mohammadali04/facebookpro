<?php

use App\Http\Controllers\auth\CustomAuthController;
use App\Http\Controllers\social\IndexController;
use App\Http\Controllers\social\MemberController;
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
    Route::get('/',[IndexController::class,'index'])->name('home');
Route::prefix('users')->group(function(){
    Route::get('/login',[CustomAuthController::class,'login'])->name('user.login');
    Route::get('/authenticate',[CustomAuthController::class,'authenticate'])->name('user.authenticate');
    Route::get('/register',[CustomAuthController::class,'register'])->name('user.register');
    Route::post('/store-register',[CustomAuthController::class,'store'])->name('user.store.register');
    Route::get('/logout',[CustomAuthController::class,'logout'])->name('user.logout');
});
Route::prefix('post')->group(function(){
    Route::post('add-post',[IndexController::class,'addPost'])->name('add.post');
    Route::post('add-like',[IndexController::class,'addLike'])->name('add.like');
    Route::post('add-comment',[IndexController::class,'addComment'])->name('add.comment');
});
Route::prefix('members')->group(function(){
    Route::get('/show',[MemberController::class,'showMembers'])->name('show.members');
    Route::post('/show-more-members',[MemberController::class,'showMoreMembers'])->name('show.more.member');
    Route::post('/add-friend-request',[MemberController::class,'sendFriendRequest'])->name('send.friend.request');
    Route::post('/accept-friend-request',[MemberController::class,'acceptFriendRequest'])->name('accept.friend.request');
});
// Route::middleware('auth')->group(function(){
//     Route::resource('user',CustomAuthController::class);
// });

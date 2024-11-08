<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ListImageController;
use App\Http\Controllers\ShowImageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShowAuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyCommentController;

Route::get('/', ListImageController::class)->name('images.all');
Route::get('/images/{image}', ShowImageController::class)->name('images.show');
Route::post('/images/{image}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/@{user:username}', ShowAuthorController::class)->name('author.show');
Route::resource('/account/images', ImageController::class)->except('show');
Route::get('/account/comments', [CommentController::class, 'index'])->name('comments.index');
Route::put('/account/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/account/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/account/comments/{comment}/reply', [ReplyCommentController::class, 'create'])->name('comments.reply.create');
Route::post('/account/comments/{comment}/reply', [ReplyCommentController::class, 'store'])->name('comments.reply.store');
Route::get('/account/settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::put('/account/settings', [SettingController::class, 'update'])->name('settings.update');

//He replaced the routes i commented out with the one in line 10

/* Route::get('/images', [ImageController::class, 'index'])->name('images.index');
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::get('/images/{image}/edit', [ImageController::class, 'edit'])->name('images.edit');//->can('update','image');
Route::put('/images/{image}', [ImageController::class, 'update'])->name('images.update');
Route::delete('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy'); */

Route::view('/test-blade', 'test');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

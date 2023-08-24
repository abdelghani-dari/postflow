<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::resource('post', PostController::class, ['except'=>['show']]);

Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/
Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::get('/',function(){
    return view('main') ;
});

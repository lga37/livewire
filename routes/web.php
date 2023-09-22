<?php

use App\Models\User;
use App\Livewire\CrudTasks;
use App\Livewire\CrudUsuarios;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Livewire\Chat;

#Route::get('/chat', Chat::class);
#Route::post('/chat', [ChatController::class, 'chat']);

Route::get('/chat', Chat::class)->name('chat');

Route::get('/tasks', CrudTasks::class)->name('tasks');


Route::get('/u', CrudUsuarios::class)->name('crud');


Route::get('/', HomeController::class)->name('home');


Route::get('/blog', [PostController::class,'index'])->name('posts.index');

Route::get('/blog/{post:slug}', [PostController::class,'show'])->name('posts.show');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('admin.User.login');
});

Route::get('/register', [UserController::class, 'showForm']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);
Route::get('/login',[UserController::class, 'showloginForm']);
Route::post('/logout', [UserController::class, 'logout']);
Route::resource('members',MemberController::class);
Route::resource('tasks',TaskController::class);

//Route::middleware(['admin'])->group(function () {
   // Route::resource('users', UserController::class);
    //Route::resource('tasks', TaskController::class);
   
//});

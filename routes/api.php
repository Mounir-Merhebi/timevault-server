<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Users\CreateCapsuleController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\Users\LoginController;
use App\Http\Controllers\Users\SignupController;
use App\Http\Controllers\Users\PublicWallController;
use App\Http\Controllers\Users\ViewCapsuleController;

Route::get('/profile', [ProfileController::class, 'test4']);
Route::get('/CreateCapsule', [CreateCapsuleController::class, 'test1']);
Route::get('/Dashboard', [DashboardController::class, 'test2']);
Route::get('/Login', [LoginController::class, 'test3']);
Route::get('/Signup', [SignupController::class, 'test6']);
Route::get('/PublicWall', [PublicWallController::class, 'test5']);
Route::get('/ViewCapsule', [ViewCapsuleController::class, 'test7']);


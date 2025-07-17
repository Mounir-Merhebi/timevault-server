<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CreateCapsuleController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\SignupController;
use App\Http\Controllers\User\PublicWallController;
use App\Http\Controllers\User\ViewCapsuleController;


Route::group(["prefix" =>"v0.1"], function(){
    Route::group(["prefix" => "user"], function(){
        Route::get('/Profile/{id}', [ProfileController::class, 'getUser']);
        Route::get('/CreateCapsule', [CreateCapsuleController::class, 'test1']);
        Route::get('/PublicWallAllCount', [PublicWallController::class, 'getAllCount']);
        Route::get('/Login', [LoginController::class, 'test3']);
        Route::get('/Signup', [SignupController::class, 'test6']);
        Route::get('/PublicWallCapsules', [PublicWallController::class, 'getAllCapsules']);
        Route::get('/ViewCapsule/{id}', [ViewCapsuleController::class, 'getCapsule']);
        Route::get('/Dashboard/{id}', [DashboardController::class, 'getUserCapsules']);
        Route::get('/DashboardTotalCount/{id}', [DashboardController::class, 'getTotalCount']);
        Route::get('/DashboardWaitingCount/{id}', [DashboardController::class, 'getWaitingCount']);
        Route::get('/DashboardPublicCount/{id}', [DashboardController::class, 'getPublicCount']);
    });
});
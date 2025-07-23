<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\CreateCapsuleController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PublicWallController;
use App\Http\Controllers\User\ViewCapsuleController;
use App\Http\Controllers\Common\AuthController;
use Illuminate\Support\Facades\Response;


Route::group(["prefix" =>"v0.1"], function(){

    Route::group(["middleware" => "auth:api"], function(){
        Route::group(["prefix" => "user"], function(){
            Route::get('/Profile/{id}', [ProfileController::class, 'getUser']);
            Route::post('/ProfileUpdate/{id}', [ProfileController::class, 'updateUser']);
            Route::post('/CreateCapsule', [CreateCapsuleController::class, 'addCapsule']);
            Route::get('/PublicWallAllCount', [PublicWallController::class, 'getAllCount']);
            Route::get('/PublicWallCapsules', [PublicWallController::class, 'getAllCapsules']);
            Route::get('/ViewCapsule/{id}', [ViewCapsuleController::class, 'getCapsule']);
            Route::get('/Dashboard/{id}', [DashboardController::class, 'getUserCapsules']);
            Route::get('/DashboardTotalCount/{id}', [DashboardController::class, 'getTotalCount']);
            Route::get('/DashboardWaitingCount/{id}', [DashboardController::class, 'getWaitingCount']);
            Route::get('/DashboardPublicCount/{id}', [DashboardController::class, 'getPublicCount']);
            Route::get('/DashboardOpenedCount/{id}', [DashboardController::class, 'getOpenedCount']);
        });

    });
      //UNAUTHENTICATED APIs
      Route::group(["prefix" => "guest"], function(){
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/register", [AuthController::class, "register"]);
    });


    Route::get('/capsule/{unlisted_link_token}', [ViewCapsuleController::class,'viewSharedCapsule']);

    Route::get('/user/app/private/images/{filename}', function ($filename) {
        $path = storage_path('app/private/images/' . $filename);
    
        if (!file_exists($path)) {
            abort(404);
        }
    
        return Response::file($path);
    });

Route::get('/app/private/audios/{filename}', function ($filename) {
    $path = storage_path('app/private/audios/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'audio/mpeg',
    ]);
});

Route::get('/app/private/notes/{filename}', function ($filename) {
    $path = storage_path('app/private/notes/' . $filename); 

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path, [
        'Content-Type' => 'text/plain', 
    ]);
});

});
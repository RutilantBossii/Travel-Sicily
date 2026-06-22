<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostController;

Route::get('/login', [ContentController::class, 'showLogin']);

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [ContentController::class, 'showRegister']);

Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout']);

Route::get('/deleteAccount', [UserController::class, 'deleteAccount']);

Route::get('/redirect/lastfm', [UserController::class, 'redirectToLastFm']);

Route::get('/callback/lastfm', [UserController::class, 'lastFMCallback']);

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/luoghi', [ContentController::class, 'showLocations']);

Route::get('/luoghi/{place}', [ContentController::class, 'showLocationID']);

Route::get('/profile/{id?}', [ContentController::class, 'showProfileID']);

Route::get('/likePost/{cardID}', [PostController::class, 'likePost']);

Route::get('/removePost/{cardID}', [PostController::class, 'removePost']);

Route::get('/verifyMod', [UserController::class, 'verifyMod']);

Route::get('/makeVisit/{placeID}', [ContentController::class, 'makeVisit']);

Route::get('/utenti', function(){
    return view('users');
});


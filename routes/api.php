<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PostController;

Route::get('/randomCover', [ApiController::class, 'randomCover']);

Route::get('/getLocations', [ApiController::class, 'getLocations']);

Route::get('/getLocationsByID/{id}', [ApiController::class, 'getLocationsByID']);

Route::post('/post', [PostController::class, 'post']);

Route::get('/getLocationPosts/{id}', [ApiController::class, 'getLocationPosts']);

Route::get('/getPostLocation/{id}', [ApiController::class, 'getPostLocation']);

Route::get('/getPostUser/{id}', [ApiController::class, 'getPostUser']);

Route::get('/getLocationStats/{id}', [ApiController::class, 'getLocationStats']);

Route::get('/getAllPosts', [ApiController::class, 'getAllPosts']);

Route::get('/getUser/{id?}', [ApiController::class, 'getUser']);

Route::get('/getUserPosts/{id}', [ApiController::class, 'getUserPosts']);

Route::get('/getLikedPosts/{id}', [ApiController::class, 'getLikedPosts']);

Route::get('/getUsers', [ApiController::class, 'getUsers']);

Route::get('/getVisited/{usrID}', [ApiController::class, 'getVisited']);

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function (){return view('home');});

// Get all posts
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);

// Grab and show specific blog post
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);

// Open the view that contains the create new post form
Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);
// Add form data to the db - Triggered as the form is submitted
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']);

// Grab specific post to edit
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); 

// Add form data to db
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); 

// Delete specific post
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); 

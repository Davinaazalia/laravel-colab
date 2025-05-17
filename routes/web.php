<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LlamaController;

Route::get('/', [WelcomeController::class, 'index']);
Route::resource('products', ProductController::class); // Ini sudah mencakup semua route CRUD untuk products
Route::get('/chatbot', function () {
    return view('chatbot');
});

Route::post('/ask-llama', [LlamaController::class, 'ask']);
Route::get('/react', function () {
    return view('react');
});








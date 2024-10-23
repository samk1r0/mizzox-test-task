<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Books;
use App\Http\Controllers\Clients;

Route::prefix('books')->group(function () {
    Route::get('/', [Books::class, 'list']);
    Route::get('/{id}', [Books::class, 'get']);
    Route::put('/rent', [Books::class, 'rent']);
});

Route::prefix('clients')->group(function () {
    Route::get('/', [Clients::class, 'list']);
    Route::get('/{id}', [Clients::class, 'get']);
    Route::post('/', [Clients::class, 'create']);
    Route::delete('/{id}', [Clients::class, 'delete']);
});

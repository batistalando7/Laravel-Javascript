<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PessoaController;
Route::redirect('/', '/home');
Route::get('/home', [PessoaController::class, 'index']);
Route::get('/pessoas/create', [PessoaController::class, 'create']);
Route::post('/pessoas/store', [PessoaController::class, 'store']);
Route::get('/pessoas/show', [PessoaController::class, 'show']);
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('v1/books', [BookController::class, 'toutvoir']);//route pour laffichage
Route::post('v1/books', [BookController::class, 'enregistrer']);//  route pour le stockage dans la table
Route::get('v1/books/{id}', [BookController::class, 'voirlivre']);//route pour l'affichage
Route::put('v1/books/{id}', [BookController::class, 'modifier']);//route pour la modification
Route::delete('v1/books/{id}', [BookController::class, 'supression']);// route pour la suppression

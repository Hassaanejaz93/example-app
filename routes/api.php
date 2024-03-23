<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// add api routes for this controller class
// app/Http/Controllers/NoteController.php
Route::get('/notes/{id}', [NoteController::class, 'show']);
//add an api route and note controller class function to read all notes

Route::get('/notes', [NoteController::class, 'index']);

//make an api route and note controler class function to add a new note
Route::post('/notes', [NoteController::class, 'customStore']);

// make an api route and note controler class function to update a note by id
Route::put('/notes/{id}', [NoteController::class, 'update']);

//make an api route and note controller class function to delete a note by id
Route::delete('/notes/{id}', [NoteController::class, 'destroy']);
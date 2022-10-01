<?php

use App\Http\Controllers\API\NotesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route notes
Route::get('notes', 'App\Http\Controllers\API\NotesController@all');
Route::post('notes', 'App\Http\Controllers\API\NotesController@notes');
Route::put('notes/{id}', 'App\Http\Controllers\API\NotesController@update');
Route::delete('notes/{id}', 'App\Http\Controllers\API\NotesController@delete');

// Route activities
Route::get('notes-id', 'App\Http\Controllers\API\NotesController@activity_id');
Route::post('notes/{id}', 'App\Http\Controllers\API\NotesController@activity');
Route::put('notes/{id}', 'App\Http\Controllers\API\NotesController@UpdateActivity');
Route::delete('notes/{id}', 'App\Http\Controllers\API\NotesController@DeleteActivity');
<?php

use App\Http\Controllers\TodoController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('todo')->group(function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('{id}/edit','edit');
        Route::put('{id}','update');
        Route::delete('{id}','destroy');
        Route::get('{id}/complete', 'complete');
    });
});

//Route::resource('todo', 'todoController');

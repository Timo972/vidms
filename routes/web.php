<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [VideoController::class, 'index'])->name('index');

Route::get('/upload', function () {
    return view('upload');
})->name('upload');
Route::post('/upload', [VideoController::class, 'upload']);

Route::get('/view/{video}', [VideoController::class, 'view'])->name('view');
Route::get('/video/{video}', [VideoController::class, 'stream'])->name('stream');

Route::delete('/delete', [VideoController::class, 'delete'])->name('delete');

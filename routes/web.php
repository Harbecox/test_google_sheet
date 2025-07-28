<?php

use App\Http\Controllers\GoogleSheetController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;

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

Route::resource('records', RecordController::class);
Route::post('records/generate', [RecordController::class, 'generate'])->name('records.generate');
Route::post('records/truncate', [RecordController::class, 'truncate'])->name('records.truncate');
Route::put('export_settings',[RecordController::class, 'export_settings'])->name('records.export_settings.update');
Route::get('fetch/{count?}',[GoogleSheetController::class,'index']);

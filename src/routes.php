<?php
use Illuminate\Support\Facades\Route;
use Rustedchip\TheDatabase\TheDatabaseController;


Route::group(['middleware' => ['web', 'auth']], function(){

Route::get('/thedatabase/thedatabasetables', [TheDatabaseController::class, 'thedatabasetables'])->name('thedatabasetables');
Route::get('/thedatabase/thetablerows/{table}', [TheDatabaseController::class, 'thetablerows'])->name('thetablerows');
Route::put('/thedatabase/tablerow/update/{table}/{row}', [TheDatabaseController::class, 'tablerowupdate'])->name('tablerowupdate');
Route::post('/thedatabase/tablerow/insert/{table}', [TheDatabaseController::class, 'tablerowinsert'])->name('tablerowinsert');
Route::get('/thedatabase/tablerow/delete/{table}/{row}', [TheDatabaseController::class, 'tablerowdelete'])->name('tablerowdelete');
});
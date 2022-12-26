<?php

use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/token', function () {
//    return csrf_token();
//});

Route::post('/showLabels', [LabelController::class, 'showLabels'])->name('showLabels');
Route::post('/addLabels', [LabelController::class, 'addLabels'])->name('addLabels');
Route::post('/deleteLabels', [LabelController::class, 'deleteLabels'])->name('deleteLabels');
Route::post('/updateLabels', [LabelController::class, 'updateLabels'])->name('updateLabels');


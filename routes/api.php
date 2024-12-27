<?php

use App\Http\Controllers\DistributionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Hello World']);
});

Route::post('distribution', [DistributionController::class, 'store'])->name('distribution.store');
Route::get('distribution', [DistributionController::class, 'index'])->name('distribution.index');
Route::get('distribution/roundings', [DistributionController::class, 'roundings'])->name('distribution.roundings');

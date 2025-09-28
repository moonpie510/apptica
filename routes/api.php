<?php

use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;

Route::controller(StatisticController::class)
    ->middleware('throttle:api')
    ->group(function () {
        Route::get('/appTopCategory', 'getAppTopCategory');
    });

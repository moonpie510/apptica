<?php

use App\Models\Application\Application;
use App\Models\Country;
use App\Repositories\AppticaRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {

});

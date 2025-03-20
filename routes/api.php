<?php

use App\Http\Controllers\SensorEntryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SensorEntryController::class, 'store'])
    ->middleware('sensor.value.parsing');

Route::get('/sensor-data', [SensorEntryController::class, 'index'])
    ->middleware(['sensor.ids.parsing', 'sensor.types.parsing']);

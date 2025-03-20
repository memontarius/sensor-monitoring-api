<?php

use App\Http\Controllers\SensorEntryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SensorEntryController::class, 'store'])
    ->middleware('sensor.value.parser');

Route::get('/sensor-data', [SensorEntryController::class, 'index'])
    ->middleware(['array.query.parser:sensors,types']);

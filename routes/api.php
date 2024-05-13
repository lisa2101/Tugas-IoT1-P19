<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\DeviceController;

Route::post('/device', [DeviceController::class, 'createDevice']);
Route::post('/log', [DeviceController::class, 'createLog']);
Route::get('/devices', [DeviceController::class, 'getAllDevices']);
Route::get('/logs/{device_id}', [DeviceController::class, 'getLogsByDevice']);
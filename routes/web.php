<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Models\City;

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

Route::get('/', [FamilyController::class, 'index'])->name('family.index');

Route::resource('family', FamilyController::class);

Route::get('/get-cities/{state}', function ($stateId) {
    return City::where('state_id', $stateId)->get();
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitizensController;
use App\Http\Controllers\LgaController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\WardsController;
use App\Models\Citizens;
use Illuminate\Support\Facades\DB;
use App\Models\Lga;
use App\Models\States;
use App\Models\Wards;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});


Route::get('/citizen/all', [CitizensController::class, 'AllCitizens'])->name('citizens');

Route::post('/citizen/add', [CitizensController::class, 'AddCitizens'])->name('store.citizens');

Route::get('/citizen/edit/{id}', [CitizensController::class, 'EditCitizens']);

Route::post('/citizen/update/{id}', [CitizensController::class, 'UpdateCitizens']);;

Route::get('delete/citizen/{id}', [CitizensController::class, 'Delete']);



// States Route

Route::get('/states/all', [StatesController::class, 'AllStates'])->name('states');

Route::post('/states/add', [StatesController::class, 'AddCitizens'])->name('store.states');

Route::get('/states/edit/{id}', [StatesController::class, 'EditCitizens']);

Route::post('/states/update/{id}', [StatesController::class, 'UpdateCitizens']);

Route::get('delete/states/{id}', [StatesController::class, 'Delete']);


// LGA Routes

Route::get('/lgas/all', [LgaController::class, 'AllLgas'])->name('lgas');

Route::post('/lgas/add', [LgaController::class, 'AddLgas'])->name('store.lgas');

Route::get('/lgas/edit/{id}', [LgaController::class, 'EditLgas']);

Route::post('/lgas/update/{id}', [LgaController::class, 'UpdateLgas']);

Route::get('delete/lgas/{id}', [LgaController::class, 'Delete']);


// Wards Routes

Route::get('/wards/all', [WardsController::class, 'AllWards'])->name('wards');

Route::post('/wards/add', [WardsController::class, 'AddWards'])->name('store.wards');

Route::get('/wards/edit/{id}', [WardsController::class, 'EditWards']);

Route::post('/wards/update/{id}', [WardsController::class, 'UpdateWards']);

Route::get('delete/wards/{id}', [WardsController::class, 'Delete']);

Route::get('wards/lgas/ajax/{state_id}', [WardsController::class, 'Get_Lgas']);

Route::get('wards/wards/ajax/{lag_id}', [WardsController::class, 'Get_Wards']);

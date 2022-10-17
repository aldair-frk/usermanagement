<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomologationController;
use App\Http\Controllers\UserController;

// Route::get('/', function () { return view('index'); });
Route::get('/', [LoginController::class, 'index']) ->name('login');
// Route::post('/', [LoginController::class, 'loginAuth']) ->name('login.loginAuth');

Route::post('/logout', [LoginController::class, 'logout']) ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/dash/tPatients', [DashboardController::class, 'totalPatients']);
Route::post('/dash/contCategory', [DashboardController::class, 'contCategory']);
Route::post('/dash/groupAge', [DashboardController::class, 'contGroupAge']);

Route::post('department/', [MainController::class, 'department']);
Route::post('provinces/', [MainController::class, 'province']);
Route::post('districts/', [MainController::class, 'district']);
Route::post('stablishments/', [MainController::class, 'stablishment']);
Route::post('stablishmentSector/', [MainController::class, 'stablishmentXSector']);
Route::post('stablishmentsAll/', [MainController::class, 'stablishmentAll']);

// Route::get('/patient', [ReportsController::class, 'indexNewUser']);
Route::get('/patient', [PatientsController::class, 'indexNewUser']);
Route::post('/patient/users', [PatientsController::class, 'searchUsers']);
Route::post('/patient/add', [PatientsController::class, 'addPatient']);
Route::post('/patient/addAttentions2', [PatientsController::class, 'addAttentionsUser']);


Route::get('/metals', [ReportsController::class, 'indexHeavyMetals']);
Route::post('/metals/list', [ReportsController::class, 'listPatients']);
Route::get('/metals/printMetals', [ReportsController::class, 'printListMetals']);
Route::get('/metals/printAll', [ReportsController::class, 'printAllMetals']);
Route::post('/metals/listAttentions', [ReportsController::class, 'listAttentions']);
Route::post('/metals/listDni', [ReportsController::class, 'listPatientsXDni']);
Route::get('/metals/printDni', [ReportsController::class, 'printMetalsXDni']);
Route::post('/metals/listCategory', [ReportsController::class, 'listPatientsXCategory']);
Route::get('/metals/printCategory', [ReportsController::class, 'printMetalsXCategory']);
Route::post('/metals/listAtenInt', [ReportsController::class, 'listAtentionsInt']);
Route::get('/metals/printAtenInt', [ReportsController::class, 'printAtentionsInt']);

Route::get('/homologation', [HomologationController::class, 'indexHomologation']);
Route::post('/homologation/month', [HomologationController::class, 'searchXMonth']);
Route::post('/homologation/addAtten', [HomologationController::class, 'addAttentions']);
Route::put('/homologation/put', [HomologationController::class, 'updatePatient']);
Route::put('/homologation/edtAtt', [HomologationController::class, 'updateAttentions']);
Route::post('/homologation/monthNoMetals', [HomologationController::class, 'searchXMonthNoMetals']);
Route::put('/homologation/edtAttNoMetals', [HomologationController::class, 'updateAttentNoMetals']);
Route::post('/homologation/addAttenNoMetals', [HomologationController::class, 'addAttenNoMetals']);


Route::get('/users', [UserController::class, 'create'])->name('create.user');  
Route::post('/panel', [UserController::class, 'saveuser'])->name('save.user');  
Route::get('/panel', [UserController::class, 'index'])->name('user.index');    
Route::get('/user/show', [UserController::class, 'show'])->name('panel.show');   


Route::put('/panel/{id}', [UserController::class, 'update'])->name('update.user');  //Actualizar
Route::delete('/panel/{id}', [UserController::class, 'destroy'])->name('delete.user');  //Eliminar




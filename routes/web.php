<?php

use App\Http\Controllers\EnfantController;
use App\Http\Controllers\infirmierController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\vaccinationcontroller;
use Illuminate\Support\Facades\Route;


#main page
Route::view('/', 'welcome');

#tous les enfants
Route::get('/infirmier/enfants', [EnfantController::class, "show_all"]);
#un seul enfant
Route::get("/infirmier/enfants/{id}", [EnfantController::class, "find"]);
#add and delete enfant
Route::get('/infirmier/createEnfant', [EnfantController::class, 'show_create']);
Route::post('/infirmier/createEnfant/validation', [EnfantController::class, 'create']);
Route::delete("{id}/delete", [EnfantController::class, 'delete']);

Route::view('/Parent', 'Parent');

#add parent
Route::get('/infirmier/createParent', [ParentController::class, "view"]);
Route::Post('/infirmier/createParent/validation', [ParentController::class, 'create']);

#profile infimirer

Route::get('/infirmier/vacciner/{id}/{vaccine}', [vaccinationcontroller::class, 'showVaccinationForm'])->name('vaccinate');
Route::get('/infirmier/vacciner', [vaccinationcontroller::class, 'showemptyForm'])->name('vaccinate');
Route::patch('/infirmier/vacciner', [vaccinationController::class, 'submitVaccinationForm'])->name('submitVaccination');

#login Infirmier
Route::get('/adminlogin', [infirmierController::class, 'adminlogin']);
Route::post('/adminlogin', [infirmierController::class, 'valider']);

#edit
Route::get('infirmier/{INP}', [infirmierController::class, 'showpfp']);
Route::get('infirmier/{INP}/edit', [infirmierController::class, 'find']);
Route::patch('infirmier/{INP}/edit/validate', [infirmierController::class, 'update']);
<?php

use App\Http\Controllers\EnfantController;
use App\Http\Controllers\infirmierController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\vaccinationcontroller;
use Illuminate\Support\Facades\Route;


#main page
Route::view('/', 'welcome');


Route::middleware(['admin'])->group(function () {
    #tous les enfants
    Route::get('/infirmier/enfants', [EnfantController::class, "show_all"]);
    #un seul enfant
    Route::get("/infirmier/enfants/{id}", [EnfantController::class, "find"]);
    #add and delete enfant
    Route::get('/infirmier/createEnfant', [EnfantController::class, 'show_create']);
    Route::post('/infirmier/createEnfant/validation', [EnfantController::class, 'create']);
    Route::delete("{id}/delete", [EnfantController::class, 'delete']);

    #add parent
    Route::get('/infirmier/createParent', [ParentController::class, "view"]);
    Route::Post('/infirmier/createParent/validation', [ParentController::class, 'create']);

    #profile infimirer
    Route::get('/infirmier/vacciner/{id}/{vaccine}', [VaccinationController::class, 'showVaccinationForm'])->name('vaccinate');
    Route::patch('/infirmier/vacciner', [VaccinationController::class, 'submitVaccinationForm'])->name('submitVaccination');
    Route::get('/infirmier/Historique', [VaccinationController::class, 'showVaccinationHistory'])->name('vaccination.history');


    #edit
    Route::get('infirmier/{INP}', [InfirmierController::class, 'showpfp'])->name('infirmier.dashboard');
    Route::get('infirmier/{INP}/edit', [InfirmierController::class, 'find']);
    Route::patch('infirmier/{INP}/edit/validate', [InfirmierController::class, 'update']);
});


#login et logout Infirmier
Route::get('/adminlogin', [infirmierController::class, 'adminlogin'])->name('adminlogin');
Route::post('/adminlogin', [infirmierController::class, 'valider']);
Route::post('/logout', [infirmierController::class, 'logout'])->name('logout');



Route::view('/Parent', 'Parent');
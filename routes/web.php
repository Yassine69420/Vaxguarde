<?php

use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ParentController;

use App\Models\Infirmier;

use Illuminate\Support\Facades\Route;




Route::view('/','welcome');

Route::get('Infirmier/{$INP}', function ($INP) {
    $infirmier = Infirmier::find($INP);
    return view("Infirmier", [
        "infirmier" => $infirmier 
    ]);
});

Route::get('/infirmier/createEnfant' , [EnfantController::class, 'show_create']);
Route::post('/infirmier/createEnfant/validation' ,[EnfantController::class, 'create']);





Route::get('/infirmier/enfants', [EnfantController::class,"show_all"]);
Route::view('/Parent','Parent');
Route::view('/infirmier','Infirmier'); 




Route::get('/infirmier/createParent', [ParentController::class,"view"]);    
Route::Post('/infirmier/createParent/validation', [ParentController::class, 'create']);      
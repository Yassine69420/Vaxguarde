<?php

use App\Models\Enfant;
use App\Models\Infirmier;
use Illuminate\Support\Facades\Route;




Route::view('/','welcome');

Route::get('Infirmier/{$INP}', function ($INP) {
    $infirmier = Infirmier::find($INP);

    return view("Infirmier", [
        "infirmier" => $infirmier 
    ]);
});

Route::get('/create' ,function (){
    
    return view('createEnfant');
});

Route::get('/infirmier/enfants', function () {
    $enfants = Enfant::all(); // Retrieve all Enfants
    return view('listeEnfants', ['enfants' => $enfants]);
});

Route::view('/Parent','Parent');
Route::view('/infirmier','Infirmier'); 
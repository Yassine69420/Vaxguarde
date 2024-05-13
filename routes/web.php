<?php

use App\Http\Controllers\EnfantController;
use App\Http\Controllers\ParentController;

use App\Models\Infirmier;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('infirmier/{INP}/edit', function ($INP) {
    $infirmier = Infirmier::findorfail($INP);
    return view('Infirmier', ['infirmier' => $infirmier]);
});

#edit
Route::patch('infirmier/{INP}/edit/validate', function ($INP) {
    request()->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'Ville' => 'required|string|max:255',
        'nom_Hopital' => 'required|string|max:255',
    ]);

    $infirmier = Infirmier::find($INP);

    if ($infirmier) {
        // Update the Infirmier attributes
        $infirmier->nom = request('nom');
        $infirmier->prenom = request('prenom');
        $infirmier->Ville = request('Ville');
        $infirmier->nom_Hopital = request('nom_Hopital');

        // Save the updated Infirmier
        $infirmier->save();

        // Redirect to the show route for the updated Infirmier
        return redirect("/infirmier/$INP");
    } else {
        abort(404);
    }
});// Assign a route name for easy reference


Route::view('/', 'welcome');

Route::get('/infirmier/createEnfant', [EnfantController::class, 'show_create']);
Route::post('/infirmier/createEnfant/validation', [EnfantController::class, 'create']);



Route::get('/infirmier/enfants', [EnfantController::class, "show_all"]);
Route::view('/Parent', 'Parent');



Route::get('/infirmier/createParent', [ParentController::class, "view"]);
Route::Post('/infirmier/createParent/validation', [ParentController::class, 'create']);



Route::get('infirmier/{INP}', function ($INP) {
    $infirmier = Infirmier::findorfail($INP);
    if ($infirmier) {
        return view('Infirmierpfp', ['infirmier' => $infirmier]);
    } else {
        abort(404);
    }
});
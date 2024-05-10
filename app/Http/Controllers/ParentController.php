<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;


class ParentController extends Controller
{

    function  view(){
    return view("createParent" );

    }
    public function create()
    {
       
        $validatedData = request()->validate([
            'CIN' => ['required', 'max:255', 'min:4'],
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3'],
            'adress' => ['required', 'max:255', 'min:3'],
            'telephone' => ['required', 'max:255', 'min:3'],
            'Ville' => ['required'],
            'date_naissance' => ['required'],
            'Email' => ['required', 'Email'],
        ]);

        // check if the parent exists in the database 
        $existingParent = ParentModel::where('CIN', $validatedData['CIN'])->first();

        if ($existingParent) {
            //if exists , redirect back to the form 
            return redirect('/infirmier/enfants');
        }
        // Create a new parent if not already existing
        ParentModel::create([
            'CIN' => $validatedData['CIN'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'adress' => $validatedData['adress'],
            'telephone' => $validatedData['telephone'],
            'Email' => request()->input('Email'),
            'ville' => $validatedData['Ville'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);

        // Redirect to createEnfant after successful creation
        return redirect('/infirmier/createEnfant');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;


class ParentController extends Controller
{

    function  view()
    {
        return view("createParent");
    }
    public function create()
    {
        #valider
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

        #voir s'il existe
        $existingParent = ParentModel::where('CIN', $validatedData['CIN'])->first();

        if ($existingParent) {
            #si oui , passer a la next page 
            return redirect('/infirmier/createEnfant');
        }
        #si non creer 
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

        #puis passer a la page suivante
        return redirect('/infirmier/createEnfant');
    }
}
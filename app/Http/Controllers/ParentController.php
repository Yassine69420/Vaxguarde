<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
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

    public function Parentlogin()
    {          #show view
        return view('Parentlogin');
    }

    public function valider()
    {        #valider
        request()->validate([
            'CIN' => 'required|string',
            'date' => 'required|date',
        ]);
        #stocker dans variables 
        $CIN = request()->input('CIN');
        $date_naissance = request()->input('date');
        #trouver 
        $parent = ParentModel::where('CIN', $CIN)->where('date_naissance', $date_naissance)->first();
        #comparer les resultats de recherche
        if ($parent) {
            #s'il exist , passer avec session
            session(['CIN' => $CIN]);

            return redirect()->route('Parentpfp', ['CIN' => $CIN]);
        } else {
            #sinon retour avec erreur
            return redirect()->route('Parentlogin')->withErrors(['CIN' => 'Donnes sont incorrects .']);
        }
    }

    public function showparent($CIN)
    {
        # Find and pass the parent information
        $parent = ParentModel::where('CIN', $CIN)->first();

        # Find the children of the parent
        $enfants = Enfant::where('CIN_Parent', $CIN)->get();

        return view('parentpfp', [
            'parent' => $parent,
            'enfants' => $enfants
        ]);
    }
}
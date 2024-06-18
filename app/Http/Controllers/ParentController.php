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
        $validatedData = request()->validate([
            'CIN' => ['required', 'max:255', 'min:4', 'string'],
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3', 'string'],
            'adress' => ['required', 'max:255', 'min:3', 'string'],
            'telephone' => ['required', 'max:255', 'min:3'],
            'Ville' => ['required', 'string'],
            'date_naissance' => ['required','date'],
            'Email' => ['required', 'email'],
        ]);

        $existingParent = ParentModel::where('CIN', $validatedData['CIN'])->first();

        if ($existingParent) {
            return redirect('/infirmier/createEnfant?CIN_Parent=' . $validatedData['CIN']);
        }

        ParentModel::create([
            'CIN' => $validatedData['CIN'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'adress' => $validatedData['adress'],
            'telephone' => $validatedData['telephone'],
            'Email' => $validatedData['Email'],
            'ville' => $validatedData['Ville'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);

        return redirect('/infirmier/createEnfant?CIN_Parent=' . $validatedData['CIN']);
    }


    function update($CIN)
    {
        request()->validate([
            'Email' => 'required|email',
            'telephone' => 'required',
            'adress' => 'required',
            'Ville' => 'required',
        ]);

        $parent = ParentModel::find($CIN);
        $parent->update([
            'Email' => request()->input('Email'),
            'telephone' => request()->input('telephone'),
            'adress' => request()->input('adress'),
            'Ville' => request()->input('Ville'),
        ]);
        $parent->save();

        return redirect("/Parent/$CIN");
    }
    public function editform($CIN)
    {          #show view
        $parent = ParentModel::where('CIN', $CIN)->first();

        return view('editform', [
            'parent' => $parent,

        ]);
    }

    public function Parentlogin()
    {          #show view
        session()->forget('CIN');
        session()->invalidate();
        session()->regenerateToken();
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
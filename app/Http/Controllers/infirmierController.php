<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;


class infirmierController extends Controller
{
    public function update($INP)
    {
        #valider
        request()->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'Ville' => 'required|string|max:255',
            'nom_Hopital' => 'required|string|max:255',
        ]);
        #trouver
        $infirmier = Infirmier::find($INP);
        #modifier
        if ($infirmier) {

            $infirmier->nom = request('nom');
            $infirmier->prenom = request('prenom');
            $infirmier->Ville = request('Ville');
            $infirmier->nom_Hopital = request('nom_Hopital');

            #sauvegarder
            $infirmier->save();


            return redirect("/infirmier/$INP");
        } else {
            #afficher erreur 
            abort(404);
        }
    }

    public function showpfp($INP)
    {     #trouver et passer les infos 
        $infirmier = Infirmier::findOrFail($INP);
        return view('Infirmierpfp', ['infirmier' => $infirmier]);
    }

    public function find($INP)
    {      #trouver et passer les infos 
        $infirmier = Infirmier::findorfail($INP);
        return view('Infirmier', ['infirmier' => $infirmier]);
    }

    public function adminlogin()
    {          #show view
        return view('adminlogin');
    }

    public function valider()
    {        #valider
        request()->validate([
            'INP' => 'required|string',
            'date' => 'required|date',
        ]);
        #stocker dans variables 
        $INP = request()->input('INP');
        $birthday = request()->input('date');
        #trouver 
        $infirmier = Infirmier::where('INP', $INP)->where('date_naissance', $birthday)->first();
        #comparer les resultats de recherche
        if ($infirmier) {
            #s'il exist , passer avec session
            session(['INP' => $INP]);

            return redirect()->route('infirmier.dashboard', ['INP' => $INP]);
        } else {
            #sinon retour avec erreur
            return redirect()->route('adminlogin')->withErrors(['INP' => 'Invalid credentials.']);
        }
    }

    public function logout()
    {
        #remove session  
        session()->forget('INP');
        session()->invalidate();
        session()->regenerateToken();
        #etourner au login
        return redirect('/adminlogin');
    }
}
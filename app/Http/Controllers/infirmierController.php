<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;


class infirmierController extends Controller
{
    function update($INP)
    {
        request()->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'Ville' => 'required|string|max:255',
            'nom_Hopital' => 'required|string|max:255',
        ]);

        $infirmier = Infirmier::find($INP);

        if ($infirmier) {

            $infirmier->nom = request('nom');
            $infirmier->prenom = request('prenom');
            $infirmier->Ville = request('Ville');
            $infirmier->nom_Hopital = request('nom_Hopital');


            $infirmier->save();


            return redirect("/infirmier/$INP");
        } else {
            abort(404);
        }
    }

    function showpfp($INP)
    {
        $infirmier = Infirmier::findOrFail($INP);
        return view('Infirmierpfp', ['infirmier' => $infirmier]);
    }

    function find($INP)
    {
        $infirmier = Infirmier::findorfail($INP);
        return view('Infirmier', ['infirmier' => $infirmier]);
    }

    function adminlogin(){
        return view('adminlogin');
    }
    function valider(){
       dd(request());
    }


    
}
<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;
use Illuminate\Contracts\Session\Session;

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

    function adminlogin()
    {
        return view('adminlogin');
    }

    public function valider()
    {
        request()->validate([
            'INP' => 'required|string',
            'date' => 'required|date',
        ]);

        $INP = request()->input('INP');
        $birthday = request()->input('date');
        
        $infirmier = Infirmier::where('INP', $INP)->where('date_naissance', $birthday)->first();

        if ($infirmier) {

            session(['INP' => $INP]);

            return redirect()->route('infirmier.dashboard', ['INP' => $INP]);

        } else {
            return redirect()->route('adminlogin')->withErrors(['INP' => 'Invalid credentials.']);
        }
    }
}
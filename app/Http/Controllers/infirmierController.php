<?php

namespace App\Http\Controllers;

use App\Models\Infirmier;
use Illuminate\Http\Request;

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

        function infpfp($INP)
        {
            $infirmier = Infirmier::findorfail($INP);
            if ($infirmier) {
                return view('Infirmierpfp', ['infirmier' => $infirmier]);
            } else {
                abort(404);
            }
        }

        function find($INP)
        {
            $infirmier = Infirmier::findorfail($INP);
            return view('Infirmier', ['infirmier' => $infirmier]);
        }
    }
}

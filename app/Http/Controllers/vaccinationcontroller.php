<?php

namespace App\Http\Controllers;

use App\Models\Enfant;

class vaccinationcontroller extends Controller
{
    public function showVaccinationForm($id, $vaccine)
    {
        return view('vaccination', compact('id', 'vaccine'));
    }

    public function showemptyForm()
    {
        return view('vaccination');
    }
    public function submitVaccinationForm()
    {
        // Retrieve the child ID and vaccine from the request
        $id = request()->input('id');
        $vaccine = request()->input('vaccine');

        // Find the Enfant model instance by ID
        $enfant = Enfant::find($id);

        if ($enfant) {
            // Dynamically set the vaccine status to true
            $vaccineField = "{$vaccine}";
            $enfant->$vaccineField = true;

          
            $enfant->save();
        }

        // Redirect after processing
        return redirect("/infirmier/enfants");
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Vaccination;

class vaccinationcontroller extends Controller
{
    public function showVaccinationForm($id, $vaccine)
    {
        return view('vaccination', compact('id', 'vaccine'));
    }

    public function showemptyForm()
    {
        return view('emptyvaccination');
    }
    public function submitVaccinationForm()
    {
        
        $id = request()->input('id');
        $vaccine = request()->input('vaccine');

      
        $enfant = Enfant::find($id);

        if ($enfant) {
          
            $vaccineField = "{$vaccine}";
            $enfant->$vaccineField = true;
          
            $enfant->save();

          
            $vaccination = new Vaccination();
            $vaccination->Date = now(); 
            $vaccination->INP_infirmier = session('INP'); 
            $vaccination->ID_enfant = $id;
            $vaccination->type_vaccination = $vaccine;
            $vaccination->save();
        }

      
        return redirect("/infirmier/enfants");
    }




    public function showVaccinationHistory()
    {
       
        $vaccinations = Vaccination::orderBy('Date', 'desc')->get();

        
        return view('history', ['vaccinations' => $vaccinations]);
    }

}
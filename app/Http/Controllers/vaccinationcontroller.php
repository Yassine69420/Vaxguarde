<?php

namespace App\Http\Controllers;


use App\Models\Enfant;
use App\Models\Vaccination;

class vaccinationcontroller extends Controller
{
    public function showVaccinationForm($id, $vaccine)
    {
        $enfant = Enfant::find($id);
        $today = date('Y-m-d');
        return view('vaccination', compact('enfant', 'vaccine', 'today'));
    }


    public function submitVaccinationForm()
    {

        $id = request()->input('id');
        $vaccine = request()->input('vaccine');
        $Date = request()->input('date');

        $enfant = Enfant::find($id);

        if ($enfant) {

            $vaccineField = "{$vaccine}";
            $enfant->$vaccineField = true;

            $enfant->save();


            $vaccination = new Vaccination();
            $vaccination->Date = $Date;
            $vaccination->INP_infirmier = session('INP');
            $vaccination->ID_enfant = $id;
            $vaccination->type_vaccination = $vaccine;
            $vaccination->save();
        }


        return redirect("/infirmier/enfants");
    }




    public function showVaccinationHistory()
    {
        $vaccinations = Vaccination::orderBy('Date', 'desc')->paginate(10);

        return view('history', [
            'vaccinations' => $vaccinations,
        ]);
    }


    public function downloadPdf()
    {
        $filePath = public_path('assets/pdfs/Manuel_d_Utulisation.pdf');
        return response()->download($filePath); // Ensure you return the response
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use Illuminate\Http\Request;

class EnfantController extends Controller
{

   function find($id){
       $enfant = Enfant::find($id);
       return view('enfantpfp', ['enfant' => $enfant]);
   }

    
    function show_all()
    {
        
        $enfants = Enfant::paginate(10);
        return view('listeEnfants', ['enfants' => $enfants]);
    }

    function show_create()
    {
        return view('createEnfant');
    }


    function delete($id) {
    $enfant = Enfant::findorfail($id);
    $enfant->delete();
    return redirect("/infirmier/enfants");
}

    public function create()
    {
        $validatedData = request()->validate([
            'CIN_Parent' => ['required', 'max:255', 'min:4'],
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3'],
            'date_naissance' => ['required'],
        ]);

        $enfantId = $this->generateUniqueEnfantId();

        Enfant::create([
            'id' => $enfantId,
            'CIN_Parent' => $validatedData['CIN_Parent'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);

        return redirect('/infirmier/enfants');
    }
    private function generateUniqueEnfantId()
    {
        do {
            $letters = chr(rand(65, 90)) . chr(rand(65, 90));
            $numbers = rand(100000, 999999);
            $enfantId = $letters . $numbers; 
            $existingEnfant = Enfant::where('id', $enfantId)->exists();
        } while ($existingEnfant);
        return $enfantId; 
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Enfant;


class EnfantController extends Controller
{
    #trouver enfant et passer les infos 
    function find($id)
    {
        $enfant = Enfant::find($id);
        return view('enfantpfp', ['enfant' => $enfant]);
    }

    #aficher tous les enfants avec pagination de 10 elements par page
    function show_all()
    {
        $enfants = Enfant::paginate(10);
        return view('listeEnfants', ['enfants' => $enfants]);
    }
    # afficher la page de creation
    function show_create()
    {
        return view('createEnfant');
    }
    # delete enfant
    function delete($id)
    {
        $enfant = Enfant::findorfail($id);
        $enfant->delete();
        return redirect("/infirmier/enfants");
    }
    #creer enfant
    public function create()
    {
        #valider
        $validatedData = request()->validate([
            'CIN_Parent' => ['required', 'max:255', 'min:4'],
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3'],
            'date_naissance' => ['required'],
        ]);
        #generer id 
        $enfantId = $this->generateUniqueEnfantId();
        #creer enfant
        Enfant::create([
            'id' => $enfantId,
            'CIN_Parent' => $validatedData['CIN_Parent'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);
        #retourner
        return redirect('/infirmier/enfants');
    }

    #methode pour generer 
    private function generateUniqueEnfantId()
    {
        #  gener un id de deux lettres et 6 chiffres , 
        #  puis voir s'il existe deja dans la DB ,
        #  si oui regener un nouveau id jusqu on trouvera pas 
        do {
            $letters = chr(rand(65, 90)) . chr(rand(65, 90));
            $numbers = rand(100000, 999999);
            $enfantId = $letters . $numbers;
            $existingEnfant = Enfant::where('id', $enfantId)->exists();
        } while ($existingEnfant);
        #retourner id 
        return $enfantId;
    }
}
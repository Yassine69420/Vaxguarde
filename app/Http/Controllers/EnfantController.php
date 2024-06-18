<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\Vaccination;

class EnfantController extends Controller
{
    #trouver enfant et passer les infos 
    function find($id)
    {

        $enfant = Enfant::find($id);
        return view('enfantpfp', ['enfant' => $enfant]);
    }
    public function pf($CIN, $id)
    {
        // Retrieve the enfant by its ID
        $enfant = Enfant::find($id);

        // Retrieve vaccinations for the enfant
        $vaccinations = Vaccination::where('ID_enfant', $id)->get();

        return view('Parentenfant', ['enfant' => $enfant, 'vaccinations' => $vaccinations]);
    }



    #affichage de tous les enfants avec pagination de 10 , ou d'un seul enfant
    public function show_all()
    {
        # Initialize the query
        $enfants = Enfant::query();

        # Validate the inputs (both are nullable)
        $search = request()->validate([
            'id' => ['nullable', 'max:8', 'min:2', 'string'],
            'nom' => ['nullable', 'string'],
        ]);

        # Apply the 'id' condition if provided
        if (!empty($search['id'])) {
            $enfants->where('id', $search['id']);
        }

        # Apply the 'nom' condition if provided
        if (!empty($search['nom'])) {
            $enfants->orWhere(Enfant::raw("CONCAT(nom, ' ', prenom)"), 'LIKE', "%" . $search['nom'] . "%");
        }

        # Order the results by 'created_at' in descending order
        $enfants->orderBy('created_at', 'desc');

        # Return the view with paginated results
        return view('listeEnfants', [
            'enfants' => $enfants->paginate(10),
        ]);
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
            'nom' => ['required', 'max:255', 'min:1', 'string'],
            'prenom' => ['required', 'max:255', 'min:3', 'string'],
            'date_naissance' => ['required','date'],
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

    #methode pour generer un ID unique
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


    public function findsingle()
    {
        // Validate the request input
        $validatedData = request()->validate([
            'ID' => ['required', 'max:255', 'min:4']
        ]);

        // Find the enfant by ID
        $enfant = Enfant::find($validatedData['ID']);

        // Check if enfant is found
        if ($enfant) {
            // Return the view with the found enfant
            return view('listeEnfants', ['enfants' => [$enfant]]);
        } else {
            // Return the view with all enfants if the specific one is not found
            $enfants = Enfant::all();
            return view('listeEnfants', ['enfants' => $enfants])
                ->with('error', 'Enfant not found, displaying all enfants.');
        }
    }
}
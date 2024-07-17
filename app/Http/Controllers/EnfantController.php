<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\ParentModel;
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

        // dd($vaccinations[1]);
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
        $enfant = Enfant::find($id);
        // dd($enfant);
        $enfant->delete();
        return redirect("/infirmier/enfants");
    }
    #creer enfant
    public function create()
    {
        // Validate request data
        $validatedData = request()->validate([
            'CIN_Parent' => ['required', 'max:255', 'min:4', 'regex:/^[A-Za-z]{1,2}\d{4,6}$/'],
            'nom' => ['required', 'max:255', 'min:1', 'string'],
            'prenom' => ['required', 'max:255', 'min:3', 'string'],
            'date_naissance' => ['required', 'date'],
        ], [
            'CIN_Parent.required' => 'Le champ CIN Parent est obligatoire.',
            'CIN_Parent.max' => 'Le CIN Parent ne doit pas dépasser 255 caractères.',
            'CIN_Parent.min' => 'Le CIN Parent doit comporter au moins 4 caractères.',
            'CIN_Parent.regex' => 'Format de CIN Parent invalide. Exemple valide: A12345.',

            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'nom.min' => 'Le nom doit comporter au moins 1 caractère.',
            'nom.string' => 'Le nom doit être une chaîne de caractères.',

            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'prenom.min' => 'Le prénom doit comporter au moins 3 caractères.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',

            'date_naissance.required' => 'Le champ date de naissance est obligatoire.',
            'date_naissance.date' => 'Format de date de naissance invalide.',
        ]);

        // Generate unique id for the enfant
        $enfantId = $this->generateUniqueEnfantId();

        // Check if parent exists
        $parent = ParentModel::find($validatedData['CIN_Parent']);
        if (!$parent) {
            return redirect()->route('creerEnfant')->withErrors(['noParent' => 'CIN Parent n\'existe pas']);
        }

        // Create enfant
        Enfant::create([
            'id' => $enfantId,
            'CIN_Parent' => $validatedData['CIN_Parent'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);

        // Redirect to the list of enfants
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
   
}

<?php

namespace App\Http\Controllers;

use App\Models\Enfant;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Storage;

class ParentController extends Controller
{

    function  view()
    {
        return view("createParent");
    }
    public function create()
    {
        $validatedData = request()->validate([
            'CIN' => ['required', 'min:4', 'string', 'regex:/^[A-Za-z]{1,2}\d{4,6}$/'],
            'nom' => ['required', 'min:3', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
            'prenom' => ['required', 'min:3', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
            'adress' => ['required', 'min:3', 'string', 'regex:/^[A-Za-z0-9À-ÿ\s\-.,]+$/'],
            'telephone' => ['required', 'min:3', 'regex:/^\d{10}$/'],
            'Ville' => ['required', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
            'date_naissance' => ['required', 'date'],
            'Email' => ['required', 'email', 'unique:App\Models\ParentModel,Email'],
        ], [
            'CIN.required' => 'Le champ CIN est obligatoire.',
            'CIN.min' => 'Le CIN doit comporter au moins 4 caractères.',
            'CIN.string' => 'Le CIN doit être une chaîne de caractères.',
            'CIN.regex' => 'Format de CIN invalide. Exemple valide: A12345.',

            'nom.required' => 'Le champ nom est obligatoire.',
            'nom.min' => 'Le nom doit comporter au moins 3 caractères.',
            'nom.regex' => 'Le nom ne peut contenir que des lettres, espaces, et tirets.',

            'prenom.required' => 'Le champ prénom est obligatoire.',
            'prenom.min' => 'Le prénom doit comporter au moins 3 caractères.',
            'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
            'prenom.regex' => 'Le prénom ne peut contenir que des lettres, espaces, et tirets.',

            'adress.required' => 'Le champ adresse est obligatoire.',
            'adress.min' => 'L\'adresse doit comporter au moins 3 caractères.',
            'adress.string' => 'L\'adresse doit être une chaîne de caractères.',
            'adress.regex' => 'L\'adresse ne peut contenir que des lettres, chiffres, espaces, tirets, virgules et points.',

            'telephone.required' => 'Le champ téléphone est obligatoire.',
            'telephone.min' => 'Le numéro de téléphone doit comporter au moins 3 chiffres.',
            'telephone.regex' => 'Format de numéro de téléphone invalide. Exemple valide: 0123456789.',

            'Ville.required' => 'Le champ Ville est obligatoire.',
            'Ville.string' => 'La Ville doit être une chaîne de caractères.',
            'Ville.regex' => 'La Ville ne peut contenir que des lettres, espaces, et tirets.',

            'date_naissance.required' => 'Le champ date de naissance est obligatoire.',
            'date_naissance.date' => 'Format de date de naissance invalide.',

            'Email.required' => 'Le champ email est obligatoire.',
            'Email.email' => 'Format d\'email invalide.',
            'Email.unique' => 'Cet email est déjà utilisé.',
        ]);

        $existingParent = ParentModel::where('CIN', $validatedData['CIN'])->first();

        if ($existingParent) {
            return redirect('/infirmier/createEnfant?CIN_Parent=' . $validatedData['CIN']);
        }

        ParentModel::create([
            'CIN' => $validatedData['CIN'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'adress' => $validatedData['adress'],
            'telephone' => $validatedData['telephone'],
            'Email' => $validatedData['Email'],
            'ville' => $validatedData['Ville'],
            'date_naissance' => $validatedData['date_naissance'],
        ]);

        return redirect('/infirmier/createEnfant?CIN_Parent=' . $validatedData['CIN']);
    }



    public function update($CIN)
    {
        // Validate request data including the profile picture
        request()->validate([
            'Email' => ['required', 'email'],
            'telephone' => ['required', 'max:255', 'min:3', 'regex:/^\d{10}$/'],
            'adress' => ['required', 'regex:/^[A-Za-z0-9À-ÿ\s\-.,]+$/'],
            'Ville' => ['required', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
            'pfp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate pfp as image file
        ], [
            'Email.required' => 'Le champ email est obligatoire.',
            'Email.email' => 'Format d\'email invalide.',

            'telephone.required' => 'Le champ téléphone est obligatoire.',
            
            'telephone.min' => 'Le numéro de téléphone doit comporter au moins 3 chiffres.',
            'telephone.regex' => 'Format de numéro de téléphone invalide. Exemple valide: 0123456789.',

            'adress.required' => 'Le champ adresse est obligatoire.',
            'adress.regex' => 'L\'adresse ne peut contenir que des lettres, chiffres, espaces, tirets, virgules et points.',

            'Ville.required' => 'Le champ Ville est obligatoire.',
            'Ville.regex' => 'La Ville ne peut contenir que des lettres, espaces, et tirets.',

            'pfp.image' => 'Le fichier doit être une image.',
            'pfp.mimes' => 'Seules les extensions jpeg, png, jpg et gif sont autorisées.',
            'pfp.max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.',
        ]);

        // Find the parent by CIN
        $parent = ParentModel::find($CIN);

        // If parent found, update fields
        if ($parent) {
            $parent->Email = request()->input('Email');
            $parent->telephone = request()->input('telephone');
            $parent->adress = request()->input('adress');
            $parent->Ville = request()->input('Ville');

            // Handle profile picture upload
            if (request()->hasFile('pfp')) {
                // Delete existing profile picture if it exists
                if ($parent->pfp) {
                    Storage::delete('public/' . $parent->pfp);
                }

                // Store new profile picture
                $image = request()->file('pfp');
                $imageName = $CIN . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/profile_pics_parents', $imageName);
                $parent->pfp = '/storage/profile_pics_parents/' . $imageName; // Store relative path to database
            }

            // Save changes
            $parent->save();

            // Redirect to parent detail page
            return redirect("/Parent/$CIN");
        } else {
            // If parent not found, show 404 error
            abort(404);
        }
    }




    public function editform($CIN)
    {          #show view
        $parent = ParentModel::where('CIN', $CIN)->first();

        return view('editform', [
            'parent' => $parent,

        ]);
    }

    public function Parentlogin()
    {          #show view
        session()->forget('CIN');
        session()->invalidate();
        session()->regenerateToken();
        return view('Parentlogin');
    }

    public function valider()
    {        #valider
        request()->validate([
            'CIN' => 'required|string|regex:/^[A-Za-z]{1,2}\d{4,6}$/',
            'date' => 'required|date',
        ]);
        #stocker dans variables 
        $CIN = request()->input('CIN');
        $date_naissance = request()->input('date');
        #trouver 
        $parent = ParentModel::where('CIN', $CIN)->where('date_naissance', $date_naissance)->first();
        #comparer les resultats de recherche
        if ($parent) {
            #s'il exist , passer avec session
            session(['CIN' => $CIN]);

            return redirect()->route('Parentpfp', ['CIN' => $CIN]);
        } else {
            #sinon retour avec erreur
            return redirect()->route('Parentlogin')->withErrors(['CIN' => 'Donnes sont incorrects .']);
        }
    }

    public function showparent($CIN)
    {
        # Find and pass the parent information
        $parent = ParentModel::where('CIN', $CIN)->first();

        # Find the children of the parent
        $enfants = Enfant::where('CIN_Parent', $CIN)->get();

        return view('parentpfp', [
            'parent' => $parent,
            'enfants' => $enfants
        ]);
    }
}
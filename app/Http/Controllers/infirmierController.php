<?php

namespace App\Http\Controllers;

use App\Mail\Adminmail;
use App\Models\Infirmier;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class infirmierController extends Controller
{

    public function showpfp()
    {
        # Retrieve the INP from the session
        $INP = session('INP');

        # Find the infirmier using the INP
        $infirmier = Infirmier::where('INP', $INP)->firstOrFail();

        # Pass the infirmier information to the view
        return view('Infirmierpfp', ['infirmier' => $infirmier]);
    }

    function welcome()
    {
        session()->forget('INP');
        session()->forget('CIN');
        session()->invalidate();
        session()->regenerateToken();
        return view('welcome');
    }
    function ajouter()
    {
        $validatedData = request()->validate(
            [
                'nom' => ['required', 'max:50', 'min:3', 'string', 'regex:/^[A-Za-z]+$/'],
                'prenom' => ['required', 'max:50', 'min:3', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
                'CIN' => ['required', 'max:255', 'min:4', 'string', 'unique:App\Models\Infirmier,CIN', 'regex:/^[A-Za-z]{1,2}\d{4,6}$/'],
                'INP' => ['required', 'max:255', 'min:3', 'unique:App\Models\Infirmier,INP', 'regex:/^\d{9}$/'],
                'Ville' => ['required', 'max:255', 'min:3', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
                'date_naissance' => ['required', 'date'],
                'nom_Hopital' => ['required', 'max:255', 'min:3', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
                'email' => ['required', 'email', 'unique:App\Models\Infirmier,Email'],
            ],
            [
                'nom.required' => 'Le champ nom est obligatoire.',
                'nom.max' => 'Le nom ne doit pas dépasser 50 caractères.',
                'nom.min' => 'Le nom doit comporter au moins 3 caractères.',
                'nom.string' => 'Le nom doit être une chaîne de caractères.',
                'nom.regex' => 'Le nom ne peut contenir que des lettres, espaces ',

                'prenom.required' => 'Le champ prénom est obligatoire.',
                'prenom.max' => 'Le prénom ne doit pas dépasser 50 caractères.',
                'prenom.min' => 'Le prénom doit comporter au moins 3 caractères.',
                'prenom.string' => 'Le prénom doit être une chaîne de caractères.',
                'prenom.regex' => 'Le prénom ne peut contenir que des lettres, espaces, et tirets.',

                'CIN.required' => 'Le champ CIN est obligatoire.',
                'CIN.max' => 'Le CIN ne doit pas dépasser 255 caractères.',
                'CIN.min' => 'Le CIN doit comporter au moins 4 caractères.',
                'CIN.string' => 'Le CIN doit être une chaîne de caractères.',
                'CIN.unique' => 'Ce CIN est déjà utilisé.',
                'CIN.regex' => 'Format de CIN invalide. Exemple valide: A12345.',

                'INP.required' => 'Le champ INP est obligatoire.',
                'INP.max' => 'L\'INP ne doit pas dépasser 255 caractères.',
                'INP.min' => 'L\'INP doit comporter au moins 3 caractères.',
                'INP.unique' => 'Cet INP est déjà utilisé.',
                'INP.regex' => 'Format d\'INP invalide. Il doit contenir exactement 9 chiffres.',

                'Ville.required' => 'Le champ Ville est obligatoire.',
                'Ville.max' => 'La Ville ne doit pas dépasser 255 caractères.',
                'Ville.min' => 'La Ville doit comporter au moins 3 caractères.',
                'Ville.string' => 'La Ville doit être une chaîne de caractères.',
                'Ville.regex' => 'La Ville ne peut contenir que des lettres, espaces, et tirets.',

                'date_naissance.required' => 'Le champ date de naissance est obligatoire.',
                'date_naissance.date' => 'Format de date de naissance invalide.',

                'nom_Hopital.required' => 'Le champ nom de l\'hôpital est obligatoire.',
                'nom_Hopital.max' => 'Le nom de l\'hôpital ne doit pas dépasser 255 caractères.',
                'nom_Hopital.min' => 'Le nom de l\'hôpital doit comporter au moins 3 caractères.',
                'nom_Hopital.string' => 'Le nom de l\'hôpital doit être une chaîne de caractères.',
                'nom_Hopital.regex' => 'Le nom de l\'hôpital ne peut contenir que des lettres, espaces, et tirets.',

                'email.required' => 'Le champ email est obligatoire.',
                'email.email' => 'Format d\'email invalide.',
                'email.unique' => 'Cet email est déjà utilisé.',
            ]
        );

        Infirmier::create([
            'CIN' => $validatedData['CIN'],
            'INP' => $validatedData['INP'],
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'Ville' => $validatedData['Ville'],
            'date_naissance' => $validatedData['date_naissance'],
            'Email' => $validatedData['email'],
            'nom_Hopital' => $validatedData['nom_Hopital'],
        ]);

        return redirect('/');
    }

    function show_form()
    {
        return view('form');
    }
    public function supprimer($INP)
    {
        $infirmier = Infirmier::findOrFail($INP);
        // dd($infirmier);
        $infirmier->delete();
        return redirect("/infirmier/Gestion");
    }
    public function show_nonAdmins()
    {
        # Initialize the query, excluding the Infirmier with INP '111111'
        $infirmiers = Infirmier::where('INP', '!=', '111111');

        # Validate the inputs (INP is nullable)
        $search = request()->validate([
            'INP' => ['nullable', 'max:8', 'min:2', 'regex:/^\d{2,8}$/'],
            'nom' => ['nullable', 'string', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'], // Alphabetic characters, spaces, accents (À-ÿ), hyphens
        ]);

        # Apply the 'INP' condition if provided
        if (!empty($search['INP'])) {
            $infirmiers->where('INP', $search['INP']);
        }

        # Apply the 'nom' condition if provided
        if (!empty($search['nom'])) {
            $infirmiers->orWhere(Infirmier::raw("CONCAT(nom, ' ', prenom)"), 'LIKE', "%" . $search['nom'] . "%");
        }

        # Return the view with paginated results
        return view('Gestion', [
            'infirmiers' => $infirmiers->paginate(10),
        ]);
    }



    public function toggleAdmin($INP)
    {
        $infirmier = Infirmier::find($INP);

        if ($infirmier) {
            $infirmier->isAdmin = !$infirmier->isAdmin;
            $infirmier->save();

            if ($infirmier->isAdmin) {
                Mail::to($infirmier->Email)->send(new Adminmail($infirmier->nom, $infirmier->prenom));
            }
        }

        return redirect('/infirmier/Gestion');
    }

    public function update($INP)
    {
        // Validate request data
        request()->validate([
            'nom' => 'required|string|max:255|regex:/^[A-Za-zÀ-ÿ\s\-]+$/',
            'prenom' => 'required|string|max:255|regex:/^[A-Za-zÀ-ÿ\s\-]+$/',
            'Ville' => 'required|string|max:255|regex:/^[A-Za-zÀ-ÿ\s\-]+$/',
            'nom_Hopital' => 'required|string|max:255|regex:/^[A-Za-zÀ-ÿ\s\-]+$/',
            'pfp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate pfp as image file
        ]);

        // Find the infirmier
        $infirmier = Infirmier::find($INP);

        // If infirmier found, update fields
        if ($infirmier) {
            $infirmier->nom = request('nom');
            $infirmier->prenom = request('prenom');
            $infirmier->Ville = request('Ville');
            $infirmier->nom_Hopital = request('nom_Hopital');

            // Handle profile picture upload
            if (request()->hasFile('pfp')) {
                // Delete existing profile picture if it exists
                if ($infirmier->pfp) {
                    Storage::delete('public/' . $infirmier->pfp);
                }

                // Store new profile picture
                $image = request()->file('pfp');
                $imageName = $INP . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/profile_pics/', $imageName);
                $infirmier->pfp = '/storage/profile_pics/' . $imageName; // Store relative path to database
            }

            // Save changes
            $infirmier->save();

            // Redirect to infirmier detail page
            return redirect("/infirmier");
        } else {
            // If infirmier not found, show 404 error
            abort(404);
        }
    }

  


    public function find()
    {      #trouver et passer les infos 
        $INP = session('INP');
        $infirmier = Infirmier::findorfail($INP);
        return view('Infirmier', ['infirmier' => $infirmier]);
    }

    public function adminlogin()
    {          #show view
        return view('adminlogin');
    }

    public function valider()
    {
        # Validate the request
        request()->validate([
            'INP' => 'required|string',
            'date' => 'required|date',
        ]);

        # Store inputs in variables
        $INP = request()->input('INP');
        $birthday = request()->input('date');

        # Find the infirmier
        $infirmier = Infirmier::where('INP', $INP)->where('date_naissance', $birthday)->first();

        # Compare the search results
        if ($infirmier) {
            # Check if the user is an admin
            if ($infirmier->isAdmin) {
                # If isAdmin is true, proceed with session
                session(['INP' => $INP]);

                return redirect()->route('infirmier.dashboard', ['INP' => $INP]);
            } else {
                # If isAdmin is false, return with an error message
                return redirect()->route('adminlogin')->withErrors(['authorization' => 'Vous n\'êtes pas autorisé encore, attendez.']);
            }
        } else {
            # If the infirmier is not found, return with an error
            return redirect()->route('adminlogin')->withErrors(['INP' => 'Les données sont incorrectes.']);
        }
    }


    public function logout()
    {
        #remove session  
        if (request()->session()->has('INP')) {
            session()->forget('INP');
            session()->invalidate();
            session()->regenerateToken();
        }

        return redirect('/');
    }
}

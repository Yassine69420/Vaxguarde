<?php

namespace App\Http\Controllers;

use App\Mail\Adminmail;
use App\Models\Infirmier;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class infirmierController extends Controller
{


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
        $validatedData = request()->validate([
            'nom' => ['required', 'max:255', 'min:3', 'string'],
            'prenom' => ['required', 'max:255', 'min:3', 'string'],
            'CIN' => ['required', 'max:255', 'min:4', 'string', 'unique:App\Models\Infirmier,CIN'],
            'INP' => ['required', 'max:255', 'min:3', 'unique:App\Models\Infirmier,INP'],
            'Ville' => ['required', 'max:255', 'min:3', 'string'],
            'date_naissance' => ['required', 'date'],
            'nom_Hopital' => ['required', 'max:255', 'min:3', 'string'],
            'email' => ['required', 'Email', 'unique:App\Models\Infirmier,Email'],
        ]);

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
            'INP' => ['nullable', 'max:8', 'min:2'],
            'nom' => ['nullable', 'string'],
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'Ville' => 'required|string|max:255',
            'nom_Hopital' => 'required|string|max:255',
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
            return redirect("/infirmier/$INP");
        } else {
            // If infirmier not found, show 404 error
            abort(404);
        }
    }

    public function showpfp($INP)
    {     #trouver et passer les infos 
        $infirmier = Infirmier::findOrFail($INP);
        return view('Infirmierpfp', ['infirmier' => $infirmier]);
    }

    public function find($INP)
    {      #trouver et passer les infos 
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

<?php

namespace App\Http\Controllers;

use App\Mail\Adminmail;
use App\Models\Infirmier;
use Illuminate\Support\Facades\Mail;

class infirmierController extends Controller
{
     function ajouter(){
        $validatedData = request()->validate([
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3'],
            'CIN' => ['required', 'max:255', 'min:4'],
            'INP' => ['required', 'max:255', 'min:3'],
            'Ville' => ['required', 'max:255', 'min:3'],
            'date_naissance' => ['required','date'],
            'nom_Hopital' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'Email'],
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
    function show_form(){
        return view('form');
    }
    function delete($INP)
    {
        $infirmier = Infirmier::findorfail($INP);
        $infirmier->delete();
        return redirect("/infirmier/Gestion");
    }
    
    public function show_nonAdmins()
    {
        $infirmiers = Infirmier::where('isAdmin', false);
        return view('Gestion', ['infirmiers' => $infirmiers->paginate(10)]);
    }

    public function makeadmin($INP)
    {
        $infirmier = Infirmier::find($INP);
        $infirmier->isAdmin = true;
        $infirmier->save();
        Mail::to($infirmier->Email)->send(new Adminmail($infirmier->nom, $infirmier->prenom));
        return redirect('/infirmier/Gestion');
    }
    public function update($INP)
    {
        #valider
        request()->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'Ville' => 'required|string|max:255',
            'nom_Hopital' => 'required|string|max:255',
        ]);
        #trouver
        $infirmier = Infirmier::find($INP);
        #modifier
        if ($infirmier) {

            $infirmier->nom = request('nom');
            $infirmier->prenom = request('prenom');
            $infirmier->Ville = request('Ville');
            $infirmier->nom_Hopital = request('nom_Hopital');

            #sauvegarder
            $infirmier->save();


            return redirect("/infirmier/$INP");
        } else {
            #afficher erreur 
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
    if(request()->session()->has('INP')){
            session()->forget('INP');
            session()->invalidate();
            session()->regenerateToken();
    }
      
        return redirect('/');
    }
}
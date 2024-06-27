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
            'CIN' => ['required', 'max:255', 'min:4', 'string', 'unique:App\Models\ParentModel,CIN'],
            'nom' => ['required', 'max:255', 'min:3'],
            'prenom' => ['required', 'max:255', 'min:3', 'string'],
            'adress' => ['required', 'max:255', 'min:3', 'string'],
            'telephone' => ['required', 'max:255', 'min:3', 'unique:App\Models\ParentModel,telephone'],
            'Ville' => ['required', 'string'],
            'date_naissance' => ['required', 'date'],
            'Email' => ['required', 'email', 'unique:App\Models\ParentModel,Email'],
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
            'Email' => ['required', 'email', 'unique:App\Models\ParentModel,Email'],
            'telephone' => ['required', 'max:255', 'min:3', 'unique:App\Models\ParentModel,telephone'],
            'adress' => 'required',
            'Ville' => 'required',
            'pfp' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate pfp as image file
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
            'CIN' => 'required|string',
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
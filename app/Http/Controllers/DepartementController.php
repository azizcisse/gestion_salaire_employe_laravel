<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::paginate(3);
        return view('departements.index', compact('departements'));
    }


    public function create()
    {
        return view('departements.create');
    }


    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }


    // Intercation avec le BD
    public function store(Departement $departement, saveDepartementRequest $request)
    {
        // Enregistrer un Nouveau Département
        try {
            $departement->nom_departement = $request->nom_departement;
            $departement->save();

            return redirect()->route('departements.index')->with('success_message', 'Département enregistré.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Departement $departement, saveDepartementRequest $request)
    {
        // Edition d'un Département
        try {
            $departement->nom_departement = $request->nom_departement;
            $departement->update();

            return redirect()->route('departements.index')->with('success_message', 'Département mis à jours.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(Departement $departement)
    {
        // Suppression d'un Département
        try {
            $departement->delete();

            return redirect()->route('departements.index')->with('success_message', 'Département Supprimé.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
}

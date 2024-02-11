<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Departement;
use App\Models\Employe;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::with('departement')->paginate(5);
        return view('employes.index', compact('employes'));
    }


    public function create()
    {
        $departements = Departement::all();
        return view('employes.create', compact('departements'));
    }


    public function edit(Employe $employe)
    {
        $departements = Departement::all();
        return view('employes.edit', compact('employe', 'departements'));
    }


    public function store(StoreEmployeRequest $storeEmployeRequest)
    {
       try {
        $query = Employe::create($storeEmployeRequest->all());

        if ($query) {
            return redirect()->route('employes.index')->with('success_message', 'Employé Ajouté. Merci');
        }
       } catch (\Throwable $th) {
        throw $th;
       }
    }


    public function update(UpdateEmployeRequest $request ,Employe $employe)
    {
        // Edition d'un Département
        try {
            $employe->departement_id = $request->departement_id;
            $employe->prenom = $request->prenom;
            $employe->nom = $request->nom;
            $employe->email = $request->email;
            $employe->telephone = $request->telephone;
            $employe->montant_journalier = $request->montant_journalier;

            $employe->update();

            return redirect()->route('employes.index')->with('success_message', 'Employé mis à jours.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete(Employe $employe)
    {
        // Suppression d'un Employé
        try {
            $employe->delete();

            return redirect()->route('employes.index')->with('success_message', 'Employé Supprimé.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

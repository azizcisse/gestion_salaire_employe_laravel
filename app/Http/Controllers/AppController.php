<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\User;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        $departementTotals = Departement::all()->count();
        $employesTotals = Employe::all()->count();
        $administrateursTotals = User::all()->count();

        $dateDefautPaiement = null;
        $notificationPaiement = "";

        $dateDuJour = Carbon::now()->day;

        $dateDefautPaiementQuery = Configuration::where('type', 'DATE_PAIEMENT')->first();

        if ($dateDefautPaiementQuery) {
            $dateDefautPaiement = $dateDefautPaiementQuery->valeur;
            $convertDatePaiement = intval($dateDefautPaiement);

            if ($dateDuJour < $convertDatePaiement) {
                $notificationPaiement = "Le Paiement doit avoir lieu le " . $dateDefautPaiement . " de ce mois. ";
            } else {
                $moisSuivant = Carbon::now()->addMonth();
                $nomMoisSuivant = $moisSuivant->format('F');
                $notificationPaiement = "Le Paiement doit avoir lieu le " . $dateDefautPaiement . " du mois de " . $nomMoisSuivant;
            }
        }

        return view('tableaubord', compact('departementTotals', 'employesTotals', 'administrateursTotals', 'notificationPaiement'));
    }
}

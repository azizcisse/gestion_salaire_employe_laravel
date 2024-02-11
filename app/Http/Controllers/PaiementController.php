<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Employe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\PaiementSalaire;

class PaiementController extends Controller
{
    public function index()
    {
        $dateDefautPaiementQuery = Configuration::where('type', 'DATE_PAIEMENT')->first();
        $dateDefautPaiement = $dateDefautPaiementQuery->valeur;
        $convertDatePaiement = intval($dateDefautPaiement);

        $dateduJour = date('d');

        $datePaiement = false;

        if ($dateduJour == $convertDatePaiement) {
            $datePaiement = true;
        }

        $paiements = PaiementSalaire::latest()->orderBy('id', 'desc')->paginate(5);
        return view('paiements.index', compact('paiements', 'datePaiement'));
    }

    public function enregistrerPaiement()
    {
        $moisMappe = [
            'JUNUARY' => 'JANVIER',
            'FEBRUARY' => 'FEVRIER',
            'MARCH' => 'MARS',
            'APRIL' => 'AVRIL',
            'MAY' => 'MAI',
            'JUNE' => 'JUIN',
            'JULLY' => 'JUILLET',
            'AUGUST' =>  'AOUT',
            'SEPTEMBER' => 'SEPTEMBRE',
            'OCTOBER' => 'OCTOBRE',
            'NOVEMBER' =>  'NOVEMBRE',
            'DECEMBER' =>  'DECEMBRE',
        ];

        $moisEnCours = strtoupper(Carbon::now()->formatLocalized('%B'));

        // Mois en Cours Français
        $moisEnCoursEnFrancais = $moisMappe[$moisEnCours] ?? '';

        // Année en Cours
        $anneeEnCours = Carbon::now()->format('Y');

        // Simuler des paiments pour tous les employés dans le mois en cours. 
        // Les paiements concernent les employeurs qui n'ont pas encore été payé dans le mois actuel

        //Recuperer la liste des employer qui n'ont pas encore été payé pour le mois en cour.
        $employes = Employe::whereDoesntHave('paiements', function ($query) use ($moisEnCoursEnFrancais, $anneeEnCours) {
            $query->where('mois_paiement', '=', $moisEnCoursEnFrancais)
                ->where('annee_paiement', '=', $anneeEnCours);
        })->get();

        if ($employes->count() === 0) {
            return redirect()->back()->with('error_message', 'Tous vos employer ont été payés pour ce mois ' . $moisEnCoursEnFrancais);
        }

        //Faire les paiement pour ces employers

        foreach ($employes as $employe) {

            $aEtePayer =  $employe->paiements()->where('mois_paiement', '=', $moisEnCoursEnFrancais)->where('annee_paiement', '=', $anneeEnCours)->exists();

            if (!$aEtePayer) {
                $salaire = $employe->montant_journalier * 30;
                $paiement = new PaiementSalaire([
                    'references' => strtoupper(Str::random(10)),
                    'employe_id' => $employe->id,
                    'montant' => $salaire,
                    'date_debut_paiement' => now(),
                    'date_validation' => now(),
                    'status' => 'REUSSI',
                    'mois_paiement' => $moisEnCoursEnFrancais,
                    'annee_paiement' => $anneeEnCours,
                ]);

                $paiement->save();
            }
        }
        //Rediriger

        return redirect()->back()->with('success_message', 'Paiement des employés effectué pour le mois de ' . $moisEnCoursEnFrancais);
    }

    public function download(PaiementSalaire $paiement)
    {
          try {
           $infoPaiementTotal = PaiementSalaire::with('employe')->find($paiement->id);

           //return view('paiements.facture', compact('infoPaiementTotal'));

           $pdf = \PDF::loadView('paiements.facture', compact('infoPaiementTotal'));
           return $pdf->download('bulletin_' . $infoPaiementTotal->employe->prenom . '.pdf');

          } catch (\Throwable $th) {
            throw $th;
          }
    }

}

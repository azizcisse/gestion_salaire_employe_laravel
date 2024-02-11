<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\updateAdminRequest;
use App\Models\CodeInitialisationMotdePasse;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\submitdefineAccessRequest;
use App\Notifications\EnvoieEmailDeNotificationApresInscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::paginate(2);
        return view('administrateurs.index', compact('admins'));
    }


    public function create()
    {
        return view('administrateurs.create');
    }


    public function edit(User $user)
    {
        return view('administrateurs.edit', compact('user'));
    }


    // Enregistrer un Admin et Envoyer un email
    public function store(storeAdminRequest $request)
    {

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            //Envoyer un mail pour que l'utilisateur puisse confirmer son compte

            //Envoyer un code par email pour vérification
            if ($user) {
                try {
                    CodeInitialisationMotdePasse::where('email', $user->email)->delete();
                    $code = rand(1000, 4000);

                    $data = [
                        'code' => $code,
                        'email' => $user->email
                    ];
                    CodeInitialisationMotdePasse::create($data);

                    Notification::route('mail', $user->email)->notify(new EnvoieEmailDeNotificationApresInscription($code, $user->email));

                    //Rediriger l'utilisateur vers une URL

                    return redirect()->route('administrateurs.index')->with('success_message', 'Administrateur Enregistré.');
                } catch (Exception $e) {
                    //dd($e);
                    throw new Exception('Une erreur est survenue lors de l\'envoi du mail.');
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(updateAdminRequest $updateAdminRequest, User $user)
    {
        try {
            //Logique de Mis à jours compte
        } catch (Exception $e) {
            //dd( $e);
            throw new Exception("Une Erreur est survenue lors de la Mis à jours des informations de l'utilisateur.");
        }
    }


    public function delete(User $user)
    {
        try {
            //Logique de la Suppression compte
            $idAdminConnecte = Auth::user()->id;

            if ($idAdminConnecte != $user->id) {
                $user->delete();

                return redirect()->back()->with('success_message', 'L\'Administrateur a été retiré du système.');
            } else {
                return redirect()->back()->with('error_message', 'Vous ne pouvez pas supprimé votre compte.');
            }

            // L'Admin qui est connecté ne puisse pas supprimer son compte

        } catch (Exception $e) {
            //dd( $e);
            throw new Exception("Une Erreur est survenue lors de la Suppression de cet utilisateur.");
        }
    }

    public function defineAccess($email)
    {
        $verificationExistanceUtilisateur = User::where('email', $email)->first();
        if ($verificationExistanceUtilisateur) {
            return view('authentication.activationCompte', compact('email'));
        } else {
            // Rediriger usr une route 404
            //return redirect()->route('login');
        }
    }

    public function submitdefineAccess(submitdefineAccessRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();

                // Si la mis à jours s'est correctement passé

                if ($user) {
                    $codeExistant = CodeInitialisationMotdePasse::where('email', $user->email)->count();

                    if ($codeExistant >= 1) {
                        CodeInitialisationMotdePasse::where('email', $user->email)->delete();
                    }
                }

                return redirect()->route('login')->with('success_message', 'Vos Accès ont été correctement définis.');
            } else {
                // 404
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\AuthenticationController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [AuthenticationController::class, 'login'])->name('login');
Route::post('/', [AuthenticationController::class, 'handleLogin'])->name('handleLogin');

Route::get('/activationCompte/{email}', [AdminController::class, 'defineAccess']);
Route::post('/activationCompte/{email}', [AdminController::class, 'submitdefineAccess'])->name('submitdefineAccess');


// Route Sécurisé
Route::middleware('auth')->group(function () {
    Route::get('tableaubord', [AppController::class, 'index'])->name('tableaubord');

    Route::prefix('departements')->group(function () {
        Route::get('/', [DepartementController::class, 'index'])->name('departements.index');
        Route::get('/create', [DepartementController::class, 'create'])->name('departements.create_departement');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departements.edit_departement');
        Route::get('/{departement}', [DepartementController::class, 'delete'])->name('departements.delete');

        Route::post('/create', [DepartementController::class, 'store'])->name('departements.store');
        Route::put('/update/{departement}', [DepartementController::class, 'update'])->name('departements.update');
    });

    Route::prefix('employes')->group(function () {
        Route::get('/', [EmployeController::class, 'index'])->name('employes.index');
        Route::get('/create', [EmployeController::class, 'create'])->name('employes.create_employe');
        Route::get('/edit/{employe}', [EmployeController::class, 'edit'])->name('employes.edit_employe');

        Route::post('/create', [EmployeController::class, 'store'])->name('employes.store');
        Route::put('/update/{employe}', [EmployeController::class, 'update'])->name('employes.update');
        Route::get('/{employe}', [EmployeController::class, 'delete'])->name('employes.delete');
    });

    Route::prefix('configurations')->group(function () {
        Route::get('/', [ConfigurationController::class, 'index'])->name('configurations.index');
        Route::get('/create', [ConfigurationController::class, 'create'])->name('configurations.create');

        Route::post('/create', [ConfigurationController::class, 'store'])->name('configurations.store');
        Route::get('/delete/{configuration}', [ConfigurationController::class, 'delete'])->name('configurations.delete');
    });


    Route::prefix('administrateurs')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('administrateurs.index');

        Route::get('/create', [AdminController::class, 'create'])->name('administrateurs.create');
        Route::post('/create', [AdminController::class, 'store'])->name('administrateurs.store');

        Route::get('/delete/{user}', [AdminController::class, 'delete'])->name('administrateurs.delete');
    });


    Route::prefix('paiements')->group(function(){
        Route::get('/', [PaiementController::class, 'index'])->name('paiements');
        Route::get('/faire', [PaiementController::class, 'enregistrerPaiement'])->name('paiements.enregistrer');

        Route::get('/delete/{paiement}', [PaiementController::class, 'delete'])->name('paiements.delete');
        Route::get('/print/{paiement}', [PaiementController::class, 'download'])->name('paiements.download');

    });
  
});

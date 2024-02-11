@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Gestion des Administrateurs.</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Editer Employé</h3>
            <div class="section-intro">Formulaire d'Edition des Employés.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('employes.update', $employe->id) }}"> @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Département</label>
                            <select name="departement_id" id="departement_id" class="form-control">
                                <option value=""></option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}" {{ $employe->departement_id == $departement->id ? 'selected' : ''}}>
                                        {{ $departement->nom_departement }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departement_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Prénom<span class="ms-2" data-container="body"
                                    data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
                                        width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                                        <circle cx="8" cy="4.5" r="1" />
                                    </svg></span></label>
                            <input type="text" class="form-control" id="setting-input-1" value="{{ $employe->prenom }}"
                                placeholder="Prénom Employé" name="prenom" required>

                        </div>

                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="setting-input-2" value="{{ $employe->nom }}"
                                placeholder="Nom Employé" name="nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="setting-input-3"
                                placeholder="gestion.salaire.employe@salam.com" name="email" value="{{ $employe->email }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="setting-input-3" value="{{ $employe->telephone }}" placeholder="77 000 00 00"
                                name="telephone">
                            @error('telephone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Montant Journalier</label>
                            <input type="number" class="form-control" id="setting-input-3" value="{{ $employe->montant_journalier }}" placeholder="1000 FCFA"
                                name="montant_journalier">
                            @error('montant_journalier')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning">Mis à Jours</button>
                        <a href="{{ route('tableaubord') }}" type="reset" class="btn btn-danger">Annuler</a>
                    </form>
                </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->
@endsection

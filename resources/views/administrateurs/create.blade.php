@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Gestion des Administrateurs.</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajouter Administrateur</h3>
            <div class="section-intro">Formulaire d'Enregistrement des Administrateurs.</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{ route('administrateurs.store') }}"> @csrf
                        @method('POST')

                       
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Nom Administrateur</label>
                            <input type="text" class="form-control" id="setting-input-2" value="{{ old('name') }}"
                                placeholder="Nom Administrateur" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="setting-input-3"
                                placeholder="gestion.salaire.employe@salam.com" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

        

                        <button type="submit" class="btn app-btn-primary">Enregistrer</button>
                        <a href="{{ route('tableaubord') }}" type="reset" class="btn btn-danger">Annuler</a>
                    </form>
                </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->
@endsection

@extends('layouts.template')

@section('content')
    <h1 class="app-page-title">Tableau de Bord</h1>

    <div class="row mt-2 mb-2 p-2">
        @if ($notificationPaiement)
            <div class="alert alert-warning"> <b>Attention : </b> {{ $notificationPaiement }}</div>
        @endif
    </div>

    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Départements Totals</h4>
                    <div class="stats-figure">{{ $departementTotals }}</div>
                    <div class="stats-meta text-success">
                        <i class="fa fa-house"></i>
                    </div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div><!--//app-card-->
        </div><!--//col-->

        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Employés Totals</h4>
                    <div class="stats-figure">{{ $employesTotals }}</div>
                    <div class="stats-meta text-success">
                        <i class="fa fa-users"></i>
                    </div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div><!--//app-card-->
        </div><!--//col-->
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Administrateurs Totals</h4>
                    <div class="stats-figure">{{ $administrateursTotals }}</div>
                    <div class="stats-meta text-success">
                        <i class="fa fa-user-lock"></i>
                    </div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div><!--//app-card-->
        </div><!--//col-->
        <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <h4 class="stats-type mb-1">Retard de Paiement</h4>
                    <div class="stats-figure">0</div>
                    <div class="stats-meta text-success">
                        <i class="fa fa-dollar"></i>
                    </div>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="#"></a>
            </div><!--//app-card-->
        </div><!--//col-->
    </div><!--//row-->
@endsection

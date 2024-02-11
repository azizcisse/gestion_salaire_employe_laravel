<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulletin de Salaire Pour les Employés</title>



    <style>
        body {
            font-family: sans-serif;
        }

        .box-container {
            width: 80%;
            padding: 2rem;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
            background-color: #ffffff;
            margin-left: 10%;
            margin-right: 10%;
        }

        .box-container .title {
            font-weight: bold;
            padding: 1rem;
            border-bottom: 1px solid #f2f2f2;
            background-color: #f2f2f2;
        }

        .transaction-box {
            margin-top: 1rem;
        }

        .transaction-box .item {
            display: table;
            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction-box .item>* {
            display: table-cell;
            vertical-align: middle;
        }

        .transaction-box .item> :first-child {
            text-align-last: left;
        }

        .transaction-box .item> :last-child {
            text-align-last: right;
            font-weight: bold;
        }

        .transaction_details_box {
            margin-top: 3rem;
            border-radius: 5px;
            display: table;
            width: 100%;
            margin-bottom: 3rem;
        }

        .transaction_details_box .left {
            display: table;
            margin-bottom: 1rem;
            width: 100%;
        }

        .transaction_details_box .left>* {
            display: table-cell;
            vertical-align: middle;
        }



        .transaction_details_box .left .item {
            display: table;
            width: 100%;
            float: left;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item>* {
            display: table-cell;
            vertical-align: middle;

            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item> :first-child {
            text-align: left;
        }

        .transaction_details_box .left .item> :last-child {
            text-align: right;
        }

        .transaction_details_box .right {
            display: table;
            width: 100%;
        }

        .transaction_details_box .right table {
            width: 100%;
        }

        .transaction_details_box .right .payment_tile {
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        th {
            background: #8a97a0;
            color: #fff;
        }

        tr {
            background: #f4f7f8;
        }

        tr:nth-child(even) {
            background: #e8eeef;
        }

        th,
        td {
            padding: 0.5rem;
        }

        .single_item .value {
            font-weight: bold;
        }
    </style>



</head>

<body>
    <div class="box-container">

        <div class="title">
            <b>Bulletin de Salaire du Mois</b>
        </div>

        <div class="transaction-box">


            <div class="item">
                <div class="label">Identifiant employe : </div>
                <div class="value">Emp {{ $infoPaiementTotal->employe->id }}</div>
            </div>
            <div class="item">
                <div class="label">Prénom & Nom : </div>
                <div class="value"> {{ $infoPaiementTotal->employe->prenom }}
                    {{ $infoPaiementTotal->employe->nom }} ({{ $infoPaiementTotal->employe->email }})</div>
            </div>
            <div class="item">
                <div class="label">Département : </div>
                <div class="value"> {{ $infoPaiementTotal->employe->departement->nom_departement }}</div>
            </div>
            <div class="item">
                <div class="label">Mois & Année : </div>
                <div class="value"> {{ $infoPaiementTotal->mois_paiement }} {{ $infoPaiementTotal->annee_paiement }} </div>
            </div>



        </div>

        <div class="last_item">

            <div class="title"> Resumé de la transaction
            </div>
            <div class="transaction_details_box">
                <div class="left">

                    <div class="item">
                        {{-- <div class="label">Référence:</div>
                        <div class="value">{{ $infoPaiementTotal->reference }}</div> --}}
                    </div>
                    <div class="item">
                        <div class="label">Frais</div>
                        <div class="value">0</div>
                    </div>
                </div>
                <div class="right">
                    <div class="payment_tile">Détails du paiement</div>
                    <table>
                        <thead>
                            <th>
                                Date
                            </th>
                            <th>Montant</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($infoPaiementTotal->date_debut_paiement)) }}</td>
                                <td>{{ $infoPaiementTotal->montant }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="single_item"> <span>Total = </span>
                                        <span class="value">{{ $infoPaiementTotal->montant }} FCFA</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <div class="single_item">
                                        <span>Total Frais</span>
                                        <span class="value">0</span>
                                    </div>
                                    <div class="single_item">
                                        <span>Total Payé</span>
                                        <span class="value">0</span>
                                    </div>
                                    <div class="single_item">
                                        <span>Reste à Payer</span>
                                        <span class="value">0</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>

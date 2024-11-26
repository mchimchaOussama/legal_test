<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .invoice-footer {
            margin-top: 30px;
            border-top: 1px solid #000;
            padding-top: 10px;
            text-align: center;
        }
        .client-info, .company-info {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #000;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
 
<div class="invoice">
    <div class="invoice-header">

        <div style="text-align: center;">
            <img width="150" src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjjTubAaMrXYGWTls9HDEuVmYS785PT-PbBv7thRoMLN8C-rgQrg8NYMEF0O09zRI-qRtoosF_yxO37AbjhsDiH_SBudN_pupSApq7HKvVw3c8UVNuisVYmVbZP7GagiqFYaGj7r5lCZWy8FRi-BoXEZtWZa4JiG5prmtanWq1YbUDi-Bi4h4ztI4ggy7NB/s1600/logo.png" alt="Lead & Boost Logo" style="display: block; border: 0; max-width: 100%; height: auto;" />
        </div>
       
        <h1>Facture</h1>
        <h4>Numéro de Facture : {{$invoice->id}}</h4>
        <p>Date : {{ now()->format('d-m-Y') }}</p>
    </div>

    <div class="client-info">
        <h5>Facturé à :</h5>
        <p>
            {{session('client_hom')->nom }} {{session('client_hom')->prenom}}<br>
            {{session('client_hom')->addresse}}<br>
            Entreprise : {{session('client_hom')->entreprise}} <br>
            Téléphone :  {{session('client_hom')->tel}}
        </p>
    </div>

    <div class="company-info">
        <h5>Émetteur :</h5>
        <p>
            LEAD & BOOST<br>
            Adresse de l'Entreprise<br>
            Ville, Code Postal<br>
            Téléphone : 0987654321
        </p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Departement</th>
                <th>Mode</th>
                <th>Prix </th>
              
            </tr>
        </thead>
        <tbody>
            @php
                    $totalHT = 0;
            @endphp
            @foreach ( session('cart') as $item)
            @if ($item['checked'])
            <tr>
                <td>{{$item['departement']}}</td>
             
                <td>{{$item['mode']}}</td>
                <td>{{$item['prix']}} €</td>
            </tr>
            @php
                $totalHT+=$item['prix'];
            @endphp
            @endif
          
            @endforeach
         
         
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;">Total HT</td>
                <td>{{number_format($totalHT * 1, 2)}} €</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">Réduction</td>
                <td>00.00</td>
            </tr>
            <tr class="total">
                <td colspan="2" style="text-align: right;">Total TTC</td>
                <td>{{number_format($totalHT * 1, 2)}} €</td>
            </tr>
        </tfoot>
    </table>

    <div class="invoice-footer">
        <p>Nous apprécions votre confiance !</p>
 
    </div>
</div>

</body>
</html>

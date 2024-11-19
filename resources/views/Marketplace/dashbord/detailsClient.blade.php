@extends('Marketplace.dashbord.layout')

@section('list-invoice')
<div class="wrap-table">
    <div class="table-responsive">

    <table id="leads_table">
        <thead>
            <tr>
                <th style="width: 0%">Mode Consommation</th>
                <th>Departement</th>   
                <th>Thematique</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Methode</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
            <tr>
                <td>{{$detail->lead->modeConsommation}}</td>
                <td>{{$detail->departement->departement}}</td>
                <td>{{ $detail->thematique->thematique }}</td>
                <td>{{ $detail->ville->ville }}</td>
                <td>{{ $detail->prix }}</td>
                <td>{{ $detail->methode }}</td>
             
                <td><a href="{{route('get.dashbord.client')}}"  class="btn btn-info">Retour</a></td>
            </tr>
            @endforeach
          <!-- Leads will be dynamically inserted here -->
        </tbody>
    </table>

    <ul id="pagination" class="pagination">
        <!-- Pagination links will be dynamically inserted here -->
    </ul>

    </div>

     </div>
@endsection
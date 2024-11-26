@extends('Marketplace.dashbord.layout')

@section('list-invoice')
<div class="wrap-table">
    <div class="table-responsive">

    <table id="leads_table">
        <thead>
            <tr>
                <th style="width: 0%">ID</th>
                <th>Montant Facture</th>
                <th>Nombre des Leads</th>
                <th>Date Facture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{$invoice->id}}</td>
                <td>{{$invoice->amount}}</td>
                <td>{{$invoice->lead_count}}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->created_at)->format('d-m-Y') }}</td>
                <td>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailsModal{{$invoice->payment_id}}" onclick="fetchInvoiceDetails({{ $invoice->payment_id }})">
                    Details
                </button>
                <a href="{{route('downloadInvoice',$invoice->id)}}"  class="btn btn-outline-danger">Telecharger</a>
             <!-- <a href="{{route('invoice.details',$invoice->payment_id)}}"  class="btn btn-outline-info">Details</a>-->
            </td>
            </tr>

            <div class="modal fade" id="detailsModal{{$invoice->payment_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl"> <!-- Changed to modal-xl for a larger modal -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Invoice Details: {{$invoice->id}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modal-body-{{$invoice->payment_id}}">
                            <!-- Leads will be loaded here -->
                            Loading...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach <!-- Leads will be dynamically inserted here -->
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-2 mx-2 py-2">
    <div class="btn-group" role="group">
        {{ $invoices->links('pagination::bootstrap-4') }}
    </div>
    </div>
    </div>
    </div>

    <script>
        
        function fetchInvoiceDetails(invoiceId) {
            $.ajax({
                url: "{{ route('fetchInvoiceDetails') }}",
                method: "GET",
                data: { invoice_id: invoiceId },
                success: function(response) {
                    $('#modal-body-' + invoiceId).html(response.html);
                },
                error: function() {
                    $('#modal-body-' + invoiceId).html('Error loading details. Please try again.');
                }
            });
        }

    </script>



@endsection
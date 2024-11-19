<div>

    @section("title")
        Coupons
    @endsection

    @section("page-title")
        COUPONS
    @endsection

    @section("element")
        <a role="button" class="btn btn-primary" href="{{ route('admin.coupon-ajouter') }}" wire:navigate>Ajouter un Coupon</a>
    @endsection

    <div class="card">
        <div class="card-body py-1 px-0 overflow-auto">

            <table class="custom-table w-100">
                <thead>
                    <th>Coupon</th>
                    <th>Réduction</th>
                    <th>Clients</th>
                    <th>Jours Restants</th>
                    <th>Supprimer</th>
                </thead>

                <tbody class="custom-striped">
                
                    @if($coupons->count() == 0)
                        <tr>
                            <td colspan="6">Aucun coupon</td>
                        </tr>
                    @endif

                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->coupon }}</td>
                        <td>{{ $coupon->reduction }} %</td>
                        <td>{{ $coupon->clients->count() }}</td>
                        <td>
                            {{ intval(Carbon\Carbon::now()->diffInDays($coupon->date_fin)) }}
                        </td>
                        <td>
                            <a href="#" title="Supprimer" wire:click="delete_coupon({{ $coupon->id }})">
                                <i class="fa-solid fa-trash-can fa-lg text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
    </div>

</div>

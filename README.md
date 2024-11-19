<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



   Illuminate\Database\QueryException

  SQLSTATE[HY000]: General error: 1005 Can't create table `lead_boost`.`publications` (errno: 150 "Foreign key constraint is incorrectly formed") (Connection: mysql, SQL: alter table `publications` add constraint `publications_lead_id_foreign` foreign key (`lead_id`) references `leads` (`id`) on delete cascade)

  at vendor\laravel\framework\src\Illuminate\Database\Connection.php:825
    821▕                     $this->getName(), $query, $this->prepareBindings($bindings), $e
    822▕                 );
    823▕             }
    824▕
  ➜ 825▕             throw new QueryException(
    826▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    827▕             );
    828▕         }
    829▕     }

  1   vendor\laravel\framework\src\Illuminate\Database\Connection.php:571
      PDOException::("SQLSTATE[HY000]: General error: 1005 Can't create table `lead_boost`.`publications` (errno: 150 "Foreign key constraint is incorrectly formed")")

  2   vendor\laravel\framework\src\Illuminate\Database\Connection.php:571
      PDOStatement::execute()


C:\Users\TECHNOLOGICA\Desktop\leads-app>


<label for="exampleDataList" class="form-label">Datalist example</label>
<input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
<datalist id="datalistOptions">
  <option value="San Francisco">
  <option value="New York">
  <option value="Seattle">
  <option value="Los Angeles">
  <option value="Chicago">
</datalist>



 <select class="form-control selectpicker @error('thematique') is-invalid @enderror"
                                                    wire:model="thematique"
                                                    data-live-search="true"
                                                    data-style="btn-primary"
                                                    title="Sélectionner une thématique">
                                                <option value="" disabled selected>Sélectionner</option>
                                                
                                                @foreach($thematique_array as $Thematique)
                                                    <option value='{{ $Thematique->id }}'>{{ $Thematique->thematique }}</option>
                                                @endforeach
                                            </select>




  ///////////////////////////////////////////////////////////////////////////

composer require stripe/stripe-php

STRIPE_KEY=your_stripe_public_key
STRIPE_SECRET=your_stripe_secret_key


php artisan make:controller PaymentController


use App\Http\Controllers\PaymentController;

Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class PaymentController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function processPayment(Request $request)
    {
        // Initialiser Stripe avec la clé secrète
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Créer un client Stripe
            $customer = Customer::create([
                'email' => $request->email,
                'source' => $request->stripeToken
            ]);

            // Créer un paiement Stripe (Charge)
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->amount * 100, // montant en centimes
                'currency' => 'usd',
                'description' => 'Paiement pour un produit'
            ]);

            // Réussite du paiement
            return back()->with('success_message', 'Paiement réussi !');
        } catch (\Exception $e) {
            // En cas d'erreur
            return back()->withErrors('Erreur : ' . $e->getMessage());
        }
    }
}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Stripe Payment</h1>

    @if (session('success_message'))
        <div class="alert alert-success">{{ session('success_message') }}</div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <input type="email" name="email" placeholder="Votre email" required>
        <input type="hidden" name="amount" value="100"> <!-- Exemple : 100$ -->

        <div id="card-element">
            <!-- Stripe insère les champs ici -->
        </div>

        <button type="submit" id="submit">Payer</button>
    </form>

    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    // Afficher l'erreur
                    console.log(result.error.message);
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>


////////////////////////////////////////////////////////////////////////////////////pypal////////////////////
composer require paypal/rest-api-sdk-php

PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_SECRET=your_paypal_secret
PAYPAL_MODE=sandbox  # ou 'live' pour le mode production


php artisan make:controller PayPalController


use App\Http\Controllers\PayPalController;

Route::get('/paypal-checkout', [PayPalController::class, 'checkout'])->name('paypal.checkout');
Route::get('/paypal-success', [PayPalController::class, 'success'])->name('paypal.success');
Route::get('/paypal-cancel', [PayPalController::class, 'cancel'])->name('paypal.cancel');



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Session;
use URL;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                env('PAYPAL_CLIENT_ID'),
                env('PAYPAL_SECRET')
            )
        );
        $this->apiContext->setConfig([
            'mode' => env('PAYPAL_MODE'),
        ]);
    }

    public function checkout()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName('Produit Exemple')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(100); // Le prix de l'article

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal(100); // Le montant total

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Paiement via PayPal pour un produit');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::route('paypal.success'))
                     ->setCancelUrl(URL::route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);

            return redirect($payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return back()->withError('Erreur de connexion PayPal : ' . $ex->getMessage());
        }
    }

    public function success(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');

        if (!$paymentId || !$payerId) {
            return redirect()->route('paypal.checkout')->withError('Paiement annulé ou échoué.');
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() === 'approved') {
                return redirect()->route('paypal.checkout')->withSuccess('Paiement approuvé !');
            }

            return redirect()->route('paypal.checkout')->withError('Paiement non approuvé.');
        } catch (\Exception $e) {
            return redirect()->route('paypal.checkout')->withError('Erreur lors du paiement : ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return redirect()->route('paypal.checkout')->withError('Paiement annulé.');
    }
}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Payment</title>
</head>
<body>
    <h1>Paiement PayPal</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('paypal.checkout') }}" method="GET">
        <button type="submit">Payer avec PayPal</button>
    </form>
</body>
</html>


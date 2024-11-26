<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkAuth;
use App\Http\Middleware\alreadyAuth;
use App\Http\Middleware\Superviseur;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\pypalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\clientDashbordController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MailingController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\importthematiqueController;

use Carbon\Carbon;


use App\Models\Commande;
use App\Models\Lead;
use App\Models\Thematique;

///////////// Accueil //////////////
use App\Livewire\Admin\Accueil as Admin_Acceuil;

////////////// Thematiques ////////////
use App\Livewire\Admin\Thematique\Index as Thematique_Index;

////////////// Departement ////////////
use App\Livewire\Admin\Departement\Index as Departement_Index;

////////////// Departement ////////////
use App\Livewire\Admin\Ville\Index as Ville_Index;
///////////////// Administrateur ////////////////////

////////////// lead ////////////
use App\Livewire\Admin\Lead\Index as Lead_Index;

////////////// Ajouter Lead ////////////
use App\Livewire\Admin\LeadAjouter\Index as Lead_Ajouter_Index;
use App\Livewire\Admin\LeadAjouter\Informatique as Lead_Ajouter_Informatique;
use App\Livewire\Admin\LeadAjouter\Telecom as Lead_Ajouter_Telecom;
use App\Livewire\Admin\LeadAjouter\Informatiqueb2b as Lead_Ajouter_Informatiqueb2b;
use App\Livewire\Admin\LeadAjouter\Enr as Lead_Ajouter_Enr;

//////// Comptes /////////
use App\Livewire\Admin\Administrateurs\Index as Adminisrateurs_Index;

/////// Ajouter Compte //////
use App\Livewire\Admin\AjouterAdministrateur\Index as AjouterAdminisrateur_Index;

////////////// lead ////////////
use App\Livewire\Admin\Profil\Index as Profil_Index;

////////////// lead ////////////
use App\Livewire\Admin\LeadModifier\Index as LeadModifier_Index;

use App\Livewire\Admin\LeadModifier\Enr as LeadModifier_Enr;

use App\Livewire\Admin\LeadModifier\Informatique as LeadModifier_Informatique;

use App\Livewire\Admin\LeadModifier\Informatiqueb2b as LeadModifier_Informatiqueb2b;

use App\Livewire\Admin\LeadModifier\Telecom as LeadModifier_Telecom;


////////////// Config ////////////
use App\Livewire\Admin\Config\Index as Config_Index;

////////////// Payment ////////////
use App\Livewire\Admin\Payment\Index as Payment_Index;
use App\Livewire\Admin\Payment\Show\Index as Payment_Show_Index;

////////////// Client ////////////
use App\Livewire\Admin\Client\Index as Client_Index;
use App\Livewire\Admin\Client\Show\Index as Client_Show_Index;

//////////// Statistics /////////////
use App\Livewire\Admin\Statistics\Index as Statistics_Index;

//////////// Coupon /////////////
use App\Livewire\Admin\Coupon\Index as Coupon_Index;
use App\Livewire\Admin\CouponAjouter\Index as Coupon_Ajouter_Index;

/////////////marketplace///////////////////////////////////////////
use App\Livewire\Marketplace\client\register as marketplace_register;

/////////////Corbeille///////////////////////////////////////////
use App\Livewire\Admin\Corbeille\Index as Admin_Corbeille;

//////review////////////////////////////////////////////////
use App\Livewire\Admin\Review\Index as Review_Index;

/////////// Demandes /////////////////
use App\Livewire\Admin\Demandes\Index as Demandes_Index;


use App\Livewire\Admin\CommandeAjouter\Index as CommandeAjouter_Index;



Route::middleware([alreadyAuth::class])->group(function(){


    Route::get("/admin/login", function(){
        return view("login.index");
    })->name('admin.login-view');

    
    Route::post("/admin/login-post", [AdminLoginController::class, "login_post"])->name("admin.login-post");

});


Route::middleware([checkAuth::class, Superviseur::class])->group(function(){

    ////////// Comptes ////////
    Route::get('/admin/comptes', Adminisrateurs_Index::class)->name('admin.comptes');

    /////////// Ajouter un compte ////////////
    Route::get('/admin/ajouter-compte', AjouterAdminisrateur_Index::class)->name('admin.ajouter-compte');

    //////// Payment //////////
    Route::get('/admin/payment', Payment_Index::class)->name('admin.payment');
    Route::get('/admin/payment/details/{leadId}', Payment_Show_Index::class)->name('admin.payment.show');

    /////// Configuration /////
    Route::get("/admin/config", Config_Index::class)->name("admin.config");

    //////// Client //////////
    Route::get('/admin/client', Client_Index::class)->name('admin.client');
    
    Route::get('/admin/client/details/{leadId}', Client_Show_Index::class)->name('admin.client.show');

    //////// Statistics ////////
    Route::get('/admin/statistics', Statistics_Index::class)->name("admin.statistics");

    Route::get("/admin/coupon", Coupon_Index::class)->name("admin.coupon");

    Route::get("/admin/coupon-ajouter", Coupon_Ajouter_Index::class)->name("admin.coupon-ajouter");

    Route::get("/admin/review", Review_Index::class)->name("admin.review");

    Route::get('/admin/commandes', Demandes_Index::class)->name('admin.demandes');

    Route::get('/admin/ajouter-lead-commande', CommandeAjouter_Index::class)->name('admin.ajouter-commande');

});


Route::middleware([checkAuth::class])->group(function(){

    ///////// Accueil /////////
    Route::get('/admin/accueil', Admin_Acceuil::class)->name('admin.accueil');

    //////////// Ajouter Lead ////////////
    Route::get('/admin/leads', Lead_Index::class)->name('admin.lead');

    Route::get('/admin/corbeille', Admin_Corbeille::class)->name('admin.corbeille');

    Route::get('/admin/lead-ajouter', Lead_Ajouter_Index::class)->name('admin.lead-ajouter');

    Route::get('/admin/lead-ajouter-telecom', Lead_Ajouter_Telecom::class)->name('admin.lead-ajouter-telecom');

    Route::get('/admin/lead-ajouter-formation-b2c', Lead_Ajouter_Informatique::class)->name('admin.lead-ajouter-informatique');

    Route::get('/admin/lead-ajouter-formation-b2b', Lead_Ajouter_Informatiqueb2b::class)->name('admin.lead-ajouter-informatique-b2b');

    Route::get('/admin/lead-ajouter-enr', Lead_Ajouter_Enr::class)->name('admin.lead-ajouter-enr');


    ///////////////////////Modifier Lead//////////////////////////////////////////////////////////////////
    Route::get('/admin/lead-modifier/{leadId}', LeadModifier_Index::class)->name('admin.lead-modifier');
    Route::get('/admin/lead-modifier/enr/{leadId}', LeadModifier_Enr::class)->name('admin.lead-modifier-enr');
    Route::get('/admin/lead-modifier/formation-b2c/{leadId}', LeadModifier_Informatique::class)->name('admin.lead-modifier-formation.b2c');
    Route::get('/admin/lead-modifier/formation-b2b/{leadId}', LeadModifier_Informatiqueb2b::class)->name('admin.lead-modifier-formation.b2b');
    Route::get('/admin/lead-modifier/telecom/{leadId}', LeadModifier_Telecom::class)->name('admin.lead-modifier-telecom');
    ///////////// Admin Logout //////////
    Route::get("/admin/logout", [AdminLoginController::class, "logout"])->name("admin.logout");

    ////////// Profil /////////
    Route::get("/admin/profil", Profil_Index::class)->name("admin.profil");

    //////// Thematique ////////
    Route::get('/admin/thematiques', Thematique_Index::class)->name('admin.thematiques');
    Route::get('/admin/departement', Departement_Index::class)->name('admin.departement');
    Route::get('/admin/ville', Ville_Index::class)->name('admin.ville');


});

Route::post('/pypal/post', [pypalController::class ,'pypal'])->name('pypal.post');
Route::get('/pypal/get/success', [pypalController::class,'success'])->name('success');
Route::get('/pypal/get/cancel', [pypalController::class,'cancel'])->name('cancel');
Route::get('/pypal/get/page', [pypalController::class,'index' ])->name('pypal.page');


Route::get("/", [HomeController::class, "get_home"])->name("get.home");
Route::get('/get-leads', [HomeController::class, 'getLeads']);


Route::get("/marketplace/marketplace", [HomeController::class, "marketplace_get"])->name("get.marketplace");
Route::post("/marketplace/marketplace", [HomeController::class, "marketplace_filter"])->name("post.marketplace");
Route::get("/marketplace/detai/{id}", [HomeController::class, "detai_get"])->name("get.detai");
Route::get("/marketplace/faq", [HomeController::class, "get_faq"])->name("get.faq");
Route::get('/marketplace/register', [HomeController::class, "get_register"])->name('get.register.marketplace');

Route::get('/api/get-departements', [HomeController::class, 'getDepartements']);
Route::get('/api/get-villes', [HomeController::class, 'getVilles']);
Route::get('/api/get-thematiques', [HomeController::class, 'getThematiques']);
Route::get('/api/get-selected-departements', [HomeController::class, 'getSelectedDepartements']);
Route::get('/api/get-selected-thematiques', [HomeController::class, 'getSelectedThematiques']);

Route::post('/api/register', [HomeController::class, 'furstStepRegister']);
Route::post('/api/login', [HomeController::class, 'login']);
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
Route::post('/track-view', [HomeController::class, 'trackLeadView'])->name('track.view');


Route::get("/marketplace/about_us", [HomeController::class, "about_us"])->name("get.about_us");

Route::get("/marketplace/contact", [HomeController::class, "contact"])->name("get.contact");

Route::post('/send-contact', [HomeController::class, 'sendContact'])->name('send.contact');

///////////////////  Dashbord  ////////////////////////
Route::get("/dashbord/client", [clientDashbordController::class, "dashbord_get"])->name("get.dashbord.client");

Route::get('/fetch-leads', [clientDashbordController::class, 'fetchLeads']);

Route::post('/profil/client', [clientDashbordController::class, 'update'])->name('update.profil.client');

Route::get("/send", [MailingController::class, "send_mail"]);

Route::post("/client/reset-password", [clientDashbordController::class, "get_resetPassword"])->name("get.reste.password");

Route::get("/update-password/{id}", [clientDashbordController::class, "get_newPassword"])->name("password.reset");

Route::post("/update-new-password", [clientDashbordController::class, "update_new_password"]);

Route::post('/send-verification-code', [clientDashbordController::class, 'sendVerificationCode']);

Route::get("/get/vocal/{id}", [HomeController::class, "acepted_vocal"])->name("acepted.vocal");

Route::post('/update-verification', [HomeController::class, 'updateVerification']);


Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');


//Gestion du panier
Route::post('/cart_add/{lead}/{src}',[CartController::class, 'addToCart'])->name('cart_add');
Route::post('/cart_remove/{leadid}', [CartController::class, 'removeCart'])->name('cart_remove');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart_index');
Route::post('/cart/update/', [CartController::class, 'update'])->name('cart.update');

//Gestion de paiement
Route::post('/paiement/',[PaymentController::class, 'showPayment'])->name('paiement.show');
Route::post('/payment/', [PaymentController::class, 'create'])->name('payment.create');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/showStripe/',[PaymentController::class, 'showStripe'])->name('payment.stripe');
Route::post('/paymentStripe/{total}', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/CreateCheckout/',[PaymentController::class, 'createCheckoutSession'])->name('payment.createCheckoutSession');
Route::get('/payment/successStripe', [PaymentController::class, 'successStripe'])->name('payment.successStripe');


Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply');


Route::get("/boxtest", function(){
    return view("boxtest");
});


Route::get('/dashbord/client/details/{idPayment}',[clientDashbordController::class, 'detailPayment'])->name('invoice.details');

Route::get('/download-invoice/{invoiceId}', [clientDashbordController::class, 'downloadInvoice'])->name('downloadInvoice');

Route::get('/fetch-invoice-details', [clientDashbordController::class, 'fetchInvoiceDetails'])->name('fetchInvoiceDetails');

Route::post('/fetch-leads', [clientDashbordController::class, 'fetchleads'])->name('fetch.leads');

Route::post('/submit-review', [clientDashbordController::class, 'sendAvis']);

Route::get('/leads-achat-detai/{leadid}', [clientDashbordController::class, 'leadsAchatDetai'])->name('detaiachatlead');

Route::get("/commandez-leads-en-quantite", [clientDashbordController::class, "demandez_devis_view"])->name("marketplace.demandes");

Route::post("/commande-post", [clientDashbordController::class, "demandez_devis_post"])->name("marketplace.commande-post");

Route::get("/dashboard/commandes", [clientDashbordController::class, "client_commandes"])->name('marketplace.client-commandes');

Route::get("/dashboard/commande/download/{id}", [clientDashbordController::class, "client_commande_download"])->name('marketplace.client-commande-download');

Route::post('/import', [importthematiqueController::class, 'import'])->name('import');

Route::get("/dashboard/commandes", [HomeController::class, "get_commandes"])->name("dashboard.client-commandes");
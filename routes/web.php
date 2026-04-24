<?php

use App\Http\Controllers\Admin\AppartementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RiadController;
use App\Http\Controllers\Admin\VillaController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ActivityController as PublicActivityController;
use App\Http\Controllers\TransportController; // Pour le site public
use App\Http\Controllers\Admin\TransportController as AdminTransportController; // Pour l'admin
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;



use App\Http\Controllers\JetController;
use App\Http\Controllers\Admin\JetController as AdminJetController;
use App\Http\Controllers\YachtController;
use App\Http\Controllers\Admin\YachtController as AdminYachtController;

/*
|--------------------------------------------------------------------------
| JETS PRIVÉS - SITE PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/jet-prive', [JetController::class, 'index'])->name('jet.index');
Route::get('/jet-prive/{jet}', [JetController::class, 'show'])->name('jet.show');
Route::post('/jet-prive/reservation', [JetController::class, 'reserve'])->name('jet.reserve');

/*
|--------------------------------------------------------------------------
| YACHTS - SITE PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/yacht', [YachtController::class, 'index'])->name('yacht.index');
Route::get('/yacht/{yacht}', [YachtController::class, 'show'])->name('yacht.show');
Route::post('/yacht/reservation', [YachtController::class, 'reserve'])->name('yacht.reserve');




Route::post('/reservation', [ReservationController::class, 'store'])->name('reservations.store');
Route::name('public.')->prefix('establishments')->group(function () {
    Route::get('/', [EstablishmentController::class, 'index'])->name('establishments.index');
    Route::get('/villas/{villa}', [EstablishmentController::class, 'showVilla'])->name('villas.show');
    Route::get('/riads/{riad}', [EstablishmentController::class, 'showRiad'])->name('riads.show');
    Route::get('/appartements/{appartement}', [EstablishmentController::class, 'showAppartement'])->name('appartements.show');
});
// Page d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Autres pages
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/activite', [PublicActivityController::class, 'index'])->name('activite');
Route::get('/activites/{activity}', [PublicActivityController::class, 'show'])->name('public.activities.show');

Route::get('/pack', function () {
    return view('pack');
})->name('pack');

Route::get('/transport', function () {
    return view('transport');
})->name('transport');

// Routes Transport Dropdown
Route::get('/location-voiture', [TransportController::class, 'showVoitures'])->name('location_voiture');

Route::get('/location-moto', [TransportController::class, 'showMotos'])->name('location_moto');

Route::get('/vip-transport', [TransportController::class, 'showVip'])->name('vip_transport');

// Route::get('/etablissement', function () {
//     return view('etablissement');
// })->name('etablissement');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/transport/{transport}', [TransportController::class, 'showPublic'])->name('public.transport.show');


// ✅ Route pour envoyer un message du formulaire de contact
Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'message' => 'required|string',
    ]);

    Mail::raw("
        Nom: {$data['name']}
        Email: {$data['email']}
        Téléphone: {$data['phone']}
        Message: {$data['message']}
    ", function ($message) use ($data) {
        $message->to('abdessamad777gt@gmail.com') // Email destinataire
                ->subject('Nouveau message de contact');
    });

    return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès !');
})->name('contact.send');

// ✅ Route de test d'envoi d'email
Route::get('/test-email', function () {
    Mail::raw('Ceci est un email de test depuis Laravel', function ($message) {
        $message->to('abdessamad777gt@gmail.com') // Email destinataire
                ->subject('Test Email Laravel');
    });

    return 'Email envoyé !';
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.attempt');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

 // Protected Admin Routes (require authentication and admin access permission)
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('villas', VillaController::class);
        Route::resource('riads', RiadController::class);
        Route::resource('appartements', AppartementController::class);
        Route::resource('transports', AdminTransportController::class);
        Route::resource('activities', AdminActivityController::class);
        Route::resource('jets', AdminJetController::class);
        Route::resource('yachts', AdminYachtController::class);
        Route::resource('reservations', \App\Http\Controllers\Admin\ReservationController::class);

    });
});

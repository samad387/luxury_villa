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

Route::get('/activite', function () {
    return view('activite');
})->name('activite');

Route::get('/pack', function () {
    return view('pack');
})->name('pack');

Route::get('/transport', function () {
    return view('transport');
})->name('transport');

// Route::get('/etablissement', function () {
//     return view('etablissement');
// })->name('etablissement');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/audiq8', function () {
    return view('audiq8');
})->name('audiq8');

Route::get('/porshmacan', function () {
    return view('porshmacan');
})->name('porshmacan');

Route::get('/touareg', function () {
    return view('touareg');
})->name('touareg');

Route::get('/golf8', function () {
    return view('golf8');
})->name('golf8');

Route::get('/mercedesclassea35d', function () {
    return view('mercedesclassea35d');
})->name('mercedesclassea35d');

Route::get('/rangerovervelar', function () {
    return view('rangerovervelar');
})->name('rangerovervelar');

Route::get('/dacia', function () {
    return view('dacia');
})->name('dacia');

Route::get('/clio5', function () {
    return view('clio5');
})->name('clio5');

Route::get('/fiat', function () {
    return view('fiat');
})->name('fiat');

Route::get('/tmax530dx', function () {
    return view('tmax530dx');
})->name('tmax530dx');

Route::get('/sh150i', function () {
    return view('sh150i');
})->name('sh150i');

Route::get('/xadv', function () {
    return view('xadv');
})->name('xadv');

Route::get('/villa4', function () {
    return view('villa4');
})->name('villa4');

Route::get('/balademontgolfiere', function () {
    return view('balademontgolfiere');
})->name('balademontgolfiere');




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
    });
});

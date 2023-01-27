<?php

use App\Models\User;
use App\Models\Insertion;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\InsertionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//* Rotta per la welcome 
Route::get('/', [Controller::class,'welcome'])->name('welcome');

//* Rotta per la creazione degli annunci 
Route::get('/new/insertion', [InsertionController::class, 'createInsertion'])->middleware(['verified', 'auth'])->name('createInsertion');
//* Rotta pagine annunci per categoria
Route::get('/buy/{category}', [InsertionController::class, 'showInsertions'])->name('showInsertions');
//* rotta del dettaglio annunci
Route::get('/{insertion}/detail' , [InsertionController::class, 'showDetail'])->name('insertionDetail');

//* Rotta per la homepage revisor
Route::get('/revisor/welcome', [UserController::class, 'revisionPage'])->middleware(['verified', 'auth'])->name('revisionPage');
//* Rotta per accettare un annuncio
Route::patch('/accept/insertion/{insertion}', [UserController::class, 'acceptInsertion'])->middleware(['verified', 'auth'])->name('acceptInsertion');
//* Rotta per sospendere un annuncio
Route::patch('/suspend/insertion/{insertion}', [UserController::class, 'suspendInsertion'])->middleware(['verified', 'auth'])->name('suspendInsertion');
//* Rotta per eliminare un annuncio
Route::delete('/delete/insertion/{insertion}', [UserController::class, 'deleteInsertion'])->middleware(['verified', 'auth'])->name('deleteInsertion');
//! rotta da usare per acquista
//* Rotta per comprare un annuncio
Route::delete('/purchase/insertion/{insertion}', [UserController::class, 'purchaseInsertion'])->middleware(['verified', 'auth'])->name('purchaseInsertion');

//* Rotta per la sezione utente
Route::get('/profile', [UserController::class, 'showProfile'])->middleware('auth')->name('profilePage');
//* Rotta richiesta revisore
Route::get('/revisor/request', [UserController::class, 'revisorRequest'])->middleware('auth')->name('requestRevisor');
//* Rotta accettazione revisore
Route::get('/newRevisor/{user}}', [UserController::class, 'makeRevisor'])->middleware('auth')->name('makeRevisor');
//* Rotta per lavorare con noi
Route::get('/workWithUs',[UserController::class, 'workWithUs'])->middleware(['verified', 'auth'])->name('workWithUs'); 

//* Rotta per la ricerca delle insertion
Route::get('/search/insertion', [UserController::class, 'searchInsertion'])->name('search.search');
//* Rotta per tutte le inserzioni
Route::get('/index', function(){
    $insertions = Insertion::all();
    return view ('insertion.insertionAll', compact ('insertions'));
});

//* Rotta cambio lingua
Route::post('/lingua/{lang}', [Controller::class, 'setLanguage'])->name('changeLanguage');

// Pagina verifica email
Route::get('/email/verify2', [UserController::class, 'emailVerify'])->name('verifyEmail');

//* Rotta per eliminare un imagine di profilo
Route::delete('/delete/profilePic/{user}', [UserController::class, 'deleteProfilePic'])->name('deleteProfilePic');

// API Login

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')
    ->redirect();
})->name('authWithGoogle');
 
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
 
    $user = User::updateOrCreate([
        'email' => $googleUser->email,

    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
    ]);

    Auth::login($user);
 
    return redirect('/new/insertion');
});
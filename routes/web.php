<?php

use Illuminate\Support\Facades\Route;
// import Article model
use App\Models\Article;
// import Groupe model
use App\Models\Groupe;
// import Famille model
use App\Models\Famille;
// import Sousfamille model
use App\Models\Sousfamille;
// import Palierprivilege model
use App\Models\Palierprivilege;
// import Commande model
use App\Models\Commande;
// import TypeArticle model
use App\Models\TypeArticle;

// import Rental model
use App\Models\Rental;
// import Auth
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/toto', function () {
    return Article::with('r_article_palierprivilege')->get();
});




// // retoune tous les articles de la db et leurs groups
// Route::get('/groups', function () {
//     return Article::all();
// });


// // retoune tous les types d'articles et leurs contenue
// // (retoune les articles en fonction de leurs types) 
// Route::get('/toto', function () {
//     return Commande::with('r_commande_client')->get();
// });
// //
// Route::get('/rental', function () {
//     return Rental::with('r_rental_statu')->get();
// });
// //
// Route::get('/property', function () {
//     return Rental::with('r_rental_user')->get();
//  });

// Route::get('/property', function () {
//     return Article::with('r_article_property_article')->get();
// });
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Groupe de route des admins
Route::group([
    "middleware" => ["auth", "auth.admin"],
    "as" => "admin."
],function(){
    Route::group([
        "prefix" => "habilitations",
        "as" => "habilitations."
    ],function(){
        Route::get("/utilisateurs", [App\Http\Controllers\UserController::class,  "index"])->name("users.index");
    });
});


//route utilisateurs avec middleware pour sécuriser l'accès a la route
// Route::get('/habilitations/utilisateurs', [App\Http\Controllers\UserController::class, 'index'])->name('utilisateurs')->middleware('auth.admin');
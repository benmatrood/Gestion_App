<?php
// import Auth
use App\Http\Livewire\Utilisateurs;
use App\Http\Livewire\GroupeComp;
use App\Http\Livewire\FamilleComp;
use App\Http\Livewire\SousfamilleComp;
use App\Http\Livewire\PalierprivilegeComp;
use App\Http\Livewire\ArticleComp;
use App\Http\Livewire\RoleComp;
use App\Http\Livewire\PermissionComp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Boutique;
use App\Models\Groupe;
use App\Models\Article;


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
        Route::get("/utilisateurs", Utilisateurs::class)->name("users.index");
        });
    // route pour la grestion des roles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/roles", Role::class)->name("roles");
        });
    
    // routes pour les groupes d'articles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/groupes", GroupeComp::class)->name("groupes");
    });
    // Routes pour les familles d'articles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/familles", FamilleComp::class)->name("familles");
    });
    // Routes pour les sous-familles d'articles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/sousfamilles", SousfamilleComp::class)->name("sousfamilles");
    });
    // Routes pour les paliers privileges d'articles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/palierprivileges", PalierprivilegeComp::class)->name("palierprivileges");
    });

    // Routes pour la gestion des articles
    Route::group([
        "prefix" => "gestarticles",
        "as" => "gestarticles."
    ],function(){
        Route::get("/articles", ArticleComp::class)->name("articles");
    });
});












// creer une route sans controller
Route::get('/test', function(){
    return User::with("r_user_boutique")->get();
});
// creer une route sans controller
Route::get('/test1', function(){
    return Boutique::with("r_boutique_user")->get();
});

Route::get('/test2', function(){
    return Article::with("r_article_groupe")->get();
});


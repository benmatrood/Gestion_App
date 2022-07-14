<?php

namespace App\Http\Livewire;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\User;
use App\Models\Article;
use App\Models\Role;
use App\Models\Boutique;
use App\Models\Groupe;
use App\Models\Famille;
use App\Models\Sousfamille;
use App\Models\Palierprivilege;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class ArticleComp extends Component
{
    // pour uploader une image
    use WithFileUploads;
    // pour pagination avce livewire et bootstrap
    protected $paginationTheme = 'bootstrap';
    // variables pour gérer les affichages des pages par livewire
    // avec livewire pour les pages list, edit et create par defaut la page list est PAGE_LIST
    public $current_page = PAGELIST;
    use WithPagination;
    // tableau pour stocker les valeurs du formulaare d'ajout d'articles
    public $new_article = [];
    // tableau pour stocker les valeurs du formulaire d'édition d'articles
    public $edit_article = [];
    // tableau pour stocker les boutiques
    public $boutique = [];
    // tableau pour stocker les roles et permissions de l'article
    public $user_roles_permissions = [];
     // variable de stockage pour le filtre de recherche
     public $search= "";
    //  variable de stockage des images pour l'article
     public $url_image;
    // création de fuction rules pour le formulaire d'édition et d'ajout d'articles
    public function rules(){
        if($this->current_page === PAGEEDITFORM){
            return [
                "edit_article.nom_article" => "required",
                "edit_article.reference" => "required",
                "edit_article.despription" => "required",
                "edit_article.id" => ["required","id",Rule::unique("article","id")->ignore($this->edit_article['id'])],
                "edit_article.groupe_id" => "required",
                "edit_article.famille_id" => "required",
                "edit_article.sousfamille_id" => "required",
                "edit_article.palierprivilege_id" => "required",
                "edit_article.stock" => "required",
                // "edit_article.url_image" => "required",
                "edit_article.groupe_id" => "required",
                // 'edit_article.url_image' => "required","image","max:1024",
            ];}
            return [
                "new_article.nom_article" => "required",
                "new_article.reference_article" => "required",
                "new_article.despription" => "required",
                "new_article.groupe_id" => "required",
                "new_article.famille_id" => "required",
                "new_article.sousfamille_id" => "required",
                "new_article.palierprivilege_id" => "required",
                "new_article.stock" => "required|min:0",


            ];    
    }
    // "new_article.url_image" => "required",
    // 'new_article.url_image' => "required","image","max:1024",
    // message d'erreur du formulaire d'ajout d'articles
    protected $messages= [
        "new_article.nom_article" => "Le nom est obligatoire",
        "new_article.reference_article" => "Le nom est obligatoire",
        "new_article.despription" => "La civilitée est obligatoire",
        "new_article.groupe_id" => "L'email est obligatoire",
        "new_article.famille_id" => "L'email n'est pas valide",
        "new_article.sousfamille_id" => "Le role est obligatoire",
        "new_article.palierprivilege_id" => "La boutique est obligatoire",
        "new_article.stock" => "le stock est obligatoire",
        "new_article.url_image" => "L'image est obligatoire",
    ];
    protected $validationAttributes = [
        'new_article.email' => 'email address'
    ];

    // function principale du composant qui sera appelé par le framework Livewire
    public function render()
    {
         // Avoir le rendu en francais
         Carbon::setLocale('fr');
         $search_criteria = "%".$this->search;
         // recherche des sousfamilles d'articles
         $data=[
             "articles" => Article::latest()->where("nom_article", "like", $search_criteria)->get()
         ];
        return view('livewire.articles.index',
        [
            // "users" =>User::latest()->paginate(8),
            "boutiques" =>Boutique::all(),
            "groupes" =>Groupe::all(),
            "familles" =>Famille::all(),
            "sousfamilles" =>Sousfamille::all(),
            "palierprivileges" =>Palierprivilege::all(),

            ], $data)
        ->extends('layouts.master')
        ->section('content');
    }

    // change la valeur de la variable current_page a PAGECREATEFORM quand il est invoqué
    public function go_to_add_user(){
            $this->current_page = PAGECREATEFORM;
        }
    // change la valeur de la variable current_page a PAGELIST quand il est invoqué
    public function go_to_user_list(){
        $this->current_page = PAGELIST;
    }

    // change la valeur de la variable current_page a PAGEEDITFORM quand il est invoqué
    // mais avant ,récupérer les données de l'article à éditer dans le tableau edit_article
    public function go_to_edit_article($id){
        $this->edit_article = Article::find($id)->toArray();
        // dump($this->edit_article);
        $this->edit_groupe = Groupe::all()->toArray();
        $groupes = $this->edit_groupe;
        $this->current_page = PAGEEDITFORM;
    }
    // ajouter un nouvel article dans la base de données
    public function add_article(){
        // vérifier si le formulaire est valide
        $validatedData = $this->validate();
        $this->validate([
            'url_image' => 'image|max:1024', // 1MB Max
        ]);
 
        $this->url_image->store('url_image');
        // j'ajoute l'image aux donnée valider avant l'insertion dans la base de données
        $validatedData['new_article']['url_image'] = $this->url_image->hashName();
        // dump($validatedData);
        // // ajouter l'article dans la base de données
        // // avant de créer l'article, vérifier que tous les champs sont remplis
        // // le model User est définit dans app/Models/User.php protected $fillable
     
        // enregister l'article dans la base de données
        Article::create($validatedData['new_article']);
        // vider le formulaire d'ajout d'articles
        $this->new_article = [];
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"L'article a été ajouté avec succès"]);
    
    }
    // Mise a jour de l'article
    public function update_article(){
        // vérifier si le formulaire est valide
        $validatedData = $this->validate();
        // editer l'article dans la base de données
        Article::find($this->edit_articler["id"])->update($validatedData['edit_article']);
        $name = $this->edit_article['nom_article'];
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Les information de $name ont été mis à jour avec succès"]);
    }
    
    // confimation de Suppression article avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer l'article $name!",
                'data'=>[
                    'article_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un article
   public function delete_article($id){
    Article::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"article supprimé avec succès"]);
   }
}

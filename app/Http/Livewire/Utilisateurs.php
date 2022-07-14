<?php

namespace App\Http\Livewire;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class Utilisateurs extends Component
{
    
    protected $paginationTheme = 'bootstrap';
    // variables pour gérer les affichages des pages par livewire
    // avec livewire pour les pages list, edit et create par defaut la page list est PAGE_LIST
    public $current_page = PAGELIST;
    use WithPagination;
    // tableau pour stocker les valeurs du formulaare d'ajout d'utilisateurs
    public $new_user = [];
    // tableau pour stocker les valeurs du formulaire d'édition d'utilisateurs
    public $edit_user = [];
    // tableau pour stocker les roles et permissions de l'utilisateur
    public $user_roles_permissions = [];
    // création de fuction rules pour le formulaire d'édition et d'ajout d'utilisateurs
    public function rules(){
        if($this->current_page === PAGEEDITFORM){
            return [
                "edit_user.nom_user" => "required",
                "edit_user.prenom_user" => "required",
                "edit_user.sexe_user" => "required",
                "edit_user.email" => ["required","email",Rule::unique("users","email")->ignore($this->edit_user['id'])],
                "edit_user.boutique_id" => "required",
            ];}
        return [
            "new_user.nom_user" => "required",
            "new_user.prenom_user" => "required",
            "new_user.sexe_user" => "required",
            "new_user.email" => "required|email",
            "new_user.boutique_id" => "required",
        ];    
    }
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        "new_user.nom_user.required" => "Le nom est obligatoire",
        "new_user.prenom_user.required" => "Le nom est obligatoire",
        "new_user.sexe_user.required" => "La civilitée est obligatoire",
        "new_user.email.required" => "L'email est obligatoire",
        "new_user.email.email" => "L'email n'est pas valide",
        "new_user.role_user.required" => "Le role est obligatoire",
        "new_user.boutique_id.required" => "La boutique est obligatoire",
    ];
    protected $validationAttributes = [
        'new_user.email' => 'email address'
    ];

    // function principale du composant qui sera appelé par le framework Livewire
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        return view('livewire.utilisateurs.index',[
            "users" =>User::latest()->paginate(8)
            ])
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
    // mais avant ,récupérer les données de l'utilisateur à éditer dans le tableau edit_user
    public function go_to_edit_user($id){
        $this->edit_user = User::find($id)->toArray();
        $this->current_page = PAGEEDITFORM;

        // cette partie cocerne les roles et permissions je la déclare 
        // ici car role et permission son sur la page d'édition d'utilisateurs
        // récupération des roles et permissions de l'utilisateur
        $this->populate_roles_permissions ();
    }
    // function pour récupérer les roles et permissions de l'utilisateur
    public function populate_roles_permissions(){
       //initialisation du tableau user_roles_permissions
        $this->user_roles_permissions["roles"] = [];
        $this->user_roles_permissions["permissions"] = [];
        //logique pour charger les roles et les permissions

        // récupération des roles de l'utilisateur par la relation user et role
        $roles = User::find($this->edit_user['id'])->r_user_role;
        // dump($roles);
        // fonction de récupération d'ID
        $map_for_colback = function($value){
            return $value['id'];
        };
        // 1. récupération des roles de l'utilisateur dans un tableau
        // le second parametre est de la fonction array_map renvoie une collection
        // qu'on converti en tableau avec la fonction toArray.Le premier paramètre 
        // récupère seulement l'ID de chaque role de l'utilisateur.Le tous est donc stocké dans le tableau $roles.
        $roles= array_map($map_for_colback,User::find($this->edit_user['id'])->r_user_role->toArray());
        // boocle sur tous les role de la DB aprtir du model Role
        foreach(Role::all() as $role){
            // si le role de la DB est dans le tableau $roles
            if(in_array($role->id,$roles)){
                // alors on l'ajoute au tableau user_roles_permissions et 
                // on joute une autre valeur (active) pour dire que le role est actif
                array_push($this->user_roles_permissions["roles"],["role_id" => $role->id,"role_name" => $role->nom_role,"active" => true]);
            }else{
                // sinon on l'ajoute au tableau user_roles_permissions et 
                // on joute une autre valeur (active) pour dire que le role est inactif
                array_push($this->user_roles_permissions["roles"],["role_id" => $role->id,"role_name" => $role->nom_role,"active" => false]);
            } 
        }
        // 2. récupération des permissions de l'utilisateur dans un tableau
        $permissions= array_map($map_for_colback,User::find($this->edit_user['id'])->r_user_permission->toArray());
        // boocle sur toutes les permissions de la DB aprtir du model Permission
        foreach(Permission::all() as $permission){
            // si la permission de la DB est dans le tableau $permissions
            if(in_array($permission->id,$permissions)){
                // alors on l'ajoute au tableau user_roles_permissions et 
                // on joute une autre valeur (active) pour dire que le permission est actif
                array_push($this->user_roles_permissions["permissions"],["permission_id" => $permission->id,"permission_name" => $permission->nom_permission,"active" => true]);
            }else{
                // sinon on l'ajoute au tableau user_roles_permissions et 
                // on joute une autre valeur (active) pour dire que le permission est inactif
                array_push($this->user_roles_permissions["permissions"],["permission_id" => $permission->id,"permission_name" => $permission->nom_permission,"active" => false]);
            } 
        }
        // dump($this->user_roles_permissions);


}
    public function add_user(){
        // vérifier si le formulaire est valide
        $validatedData = $this->validate();
        // ajouter l'utilisateur dans la base de données
        // avant de créer l'utilisateur, vérifier que tous les champs sont remplis
        // le model User est définit dans app/Models/User.php protected $fillable
        // j'ajoute le password aux donnée valider avant l'insertion dans la base de données
        $validatedData['new_user']['password'] = Hash::make(DEFAULTPASSWORD);
        User::create($validatedData['new_user']);
        // vider le formulaire d'ajout d'utilisateurs
        $this->new_user = [];
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"L'utilisateur a été ajouté avec succès"]);
    }
    // Mise a jour de l'utilisateur
    public function update_user(){
        // vérifier si le formulaire est valide
        $validatedData = $this->validate();
        // editer l'utilisateur dans la base de données
        User::find($this->edit_user["id"])->update($validatedData['edit_user']);
        // vider le formulaire d'édition d'utilisateurs
        $nom = $this->edit_user["nom_user"];
        $prenom = $this->edit_user["prenom_user"];
        $name = $nom." ".$prenom;
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Les information de $name ont été mis à jour avec succès"]);
    }
    // Réinitialiser le mot de passe par defaut
    public function reset_default_password(){
        User::find($this->edit_user["id"])->update(['password'=>Hash::make(DEFAULTPASSWORD)]);
        $nom = $this->edit_user["nom_user"];
        $prenom = $this->edit_user["prenom_user"];
        $name = $nom." ".$prenom;
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Le mot de passe de $name a été réinitialisé avec succès"]);
    }
    // Mise a jour des roles et permissions de l'utilisateur
    public function update_roles_and_permissions(){
        // récupérer les roles et supprimer les roles et permissions de l'utilisateur
        DB::table('user_role')->where('user_id',$this->edit_user["id"])->delete();
        DB::table('user_permission')->where('user_id',$this->edit_user["id"])->delete();
        // ajouter les nouveaux roles  a l'utilisateur
        // on vérifie pendant la boocle si le role est actif et on l'ajoute à la base de données
        foreach($this->user_roles_permissions["roles"] as $role){
            if($role["active"]){
                User::find($this->edit_user["id"])->r_user_role()->attach($role["role_id"]);
            }
        }
        // ajouter les nouvels permissions  a l'utilisateur
        // on vérifie pendant la boocle si la permision est actif et on l'ajoute à la base de données
        foreach($this->user_roles_permissions["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->edit_user["id"])->r_user_permission()->attach($permission["permission_id"]);
            }
        }
       
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $nom = $this->edit_user["nom_user"];
        $prenom = $this->edit_user["prenom_user"];
        $name = $nom." ".$prenom;
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Rôles et permissions  de $name  mis à jour avec succès"]);
    }
    // confimation de Suppression utilisateur avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer l'utilisateur $name!",
                'data'=>[
                    'user_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_user($id){
    User::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Utilisateur supprimé avec succès"]);
   }
}

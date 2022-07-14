<?php

namespace App\Http\Livewire;
use App\Models\Role;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class RoleComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de role
    public $is_add_role = false;
    // pour récuprer la valeur du nom du role à ajouter
    public $new_role_name = "";
    // pour recupérer la nouvel valeur du role(pour la modification)
    public $new_role_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_role_name.required' => 'Le nom du role est obligatoire et doit comporter au moins 2 caractères',
        'new_role_name.unique' => 'Ce nom de role existe déjà',
        'new_role_name.min' => 'Le nom du role doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des roles d'articles
        $data=[
            "roles" => Role::latest()->where("nom_role", "like", $search_criteria)->get()
        ];
        return view('livewire.roles.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de role
    public function toggle_show_add_role()
    {
        if($this->is_add_role){
            $this->is_add_role = false;
            // on vide le champ de saisie
            $this->new_role_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_role_name']);
        }else{
            $this->is_add_role = true;      
    }
    }
    // fonction de gestion de l'ajout de role(validation)
    public function add_new_role()
    {
        // s'assurer d'ajouter nom_role a protected $fillable dans la classe role 
        $this->validate([
            'new_role_name' => 'required|min:2|max:50|unique:roles,nom_role'
        ]);
        // ajout du role dans la base de données
        Role::create([
            "nom_role" => strtoupper($this->new_role_name)
        ]);
        // masquage du champ d'ajout de role
        $this->is_add_role = false;
        // réinitialisation du champ de saisie
        $this->new_role_name = "";
          //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"role ajouté avec succès!"]);
    }
    // edition du nom du role
    public function edit_role($id)
    {
        // récupération du role à éditer
        $role = Role::find($id);
        // envoie du role à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'role' => $role
        ]);
       
    }
    // update du nom du role
    public function update_role($id, $value_from_js){
        // récupération du role à modifier($value_from_js provient du js il
        //  est appeller value et new_role_value est la varriable public declarée un peut plus haut)
        $this->new_role_value = $value_from_js;
        // dump($this->new_role_value);
        // validation du role à modifier
        $validated = $this->validate([
            'new_role_value' => ["required","min:2","max:50", Rule::unique('roles',"nom_role")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du role à éditer et faire le update
        Role::find($id)->update(["nom_role" => $validated["new_role_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"role mis à jour avec succès!"]);

    }
    // suppression du role
    // confimation de Suppression du role avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer le role $name!",
                'data'=>[
                    'role_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_role($id){
    Role::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"role supprimé avec succès"]);
   }
}

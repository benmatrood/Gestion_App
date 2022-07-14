<?php

namespace App\Http\Livewire;
use App\Models\permission;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class PermissionComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de permission
    public $is_add_permission = false;
    // pour récuprer la valeur du nom du permission à ajouter
    public $new_permission_name = "";
    // pour recupérer la nouvel valeur du permission(pour la modification)
    public $new_permission_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_permission_name.required' => 'Le nom du permission est obligatoire et doit comporter au moins 2 caractères',
        'new_permission_name.unique' => 'Ce nom de permission existe déjà',
        'new_permission_name.min' => 'Le nom du permission doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des permissions d'articles
        $data=[
            "permissions" => Permission::latest()->where("nom_permission", "like", $search_criteria)->get()
        ];
        return view('livewire.permissions.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de permission
    public function toggle_show_add_permission()
    {
        if($this->is_add_permission){
            $this->is_add_permission = false;
            // on vide le champ de saisie
            $this->new_permission_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_permission_name']);
        }else{
            $this->is_add_permission = true;      
    }
    }
    // fonction de gestion de l'ajout de permission(validation)
    public function add_new_permission()
    {
        // s'assurer d'ajouter nom_permission a protected $fillable dans la classe permission 
        $this->validate([
            'new_permission_name' => 'required|min:2|max:50|unique:permissions,nom_permission'
        ]);
        // ajout du permission dans la base de données
        Permission::create([
            "nom_permission" => strtoupper($this->new_permission_name)
        ]);
        // masquage du champ d'ajout de permission
        $this->is_add_permission = false;
        // réinitialisation du champ de saisie
        $this->new_permission_name = "";
          //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"permission ajouté avec succès!"]);
    }
    // edition du nom du permission
    public function edit_permission($id)
    {
        // récupération du permission à éditer
        $permission = Permission::find($id);
        // envoie du permission à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'permission' => $permission
        ]);
       
    }
    // update du nom du permission
    public function update_permission($id, $value_from_js){
        // récupération du permission à modifier($value_from_js provient du js il
        //  est appeller value et new_permission_value est la varriable public declarée un peut plus haut)
        $this->new_permission_value = $value_from_js;
        // dump($this->new_permission_value);
        // validation du permission à modifier
        $validated = $this->validate([
            'new_permission_value' => ["required","min:2","max:50", Rule::unique('permissions',"nom_permission")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du permission à éditer et faire le update
        Permission::find($id)->update(["nom_permission" => $validated["new_permission_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"permission mis à jour avec succès!"]);

    }
    // suppression du permission
    // confimation de Suppression du permission avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer le permission $name!",
                'data'=>[
                    'permission_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_permission($id){
    Permission::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"permission supprimé avec succès"]);
   }
}

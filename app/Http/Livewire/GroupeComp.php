<?php

namespace App\Http\Livewire;
use App\Models\Groupe;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class GroupeComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de groupe
    public $is_add_groupe = false;
    // pour récuprer la valeur du nom du groupe à ajouter
    public $new_groupe_name = "";
    // pour recupérer la nouvel valeur du groupe(pour la modification)
    public $new_groupe_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_groupe_name.required' => 'Le nom du groupe est obligatoire et doit comporter au moins 2 caractères',
        'new_groupe_name.unique' => 'Ce nom de groupe existe déjà',
        'new_groupe_name.min' => 'Le nom du groupe doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des groupes d'articles
        $data=[
            "groupes" => Groupe::latest()->where("nom_groupe", "like", $search_criteria)->get()
        ];
        return view('livewire.groupes.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de groupe
    public function toggle_show_add_groupe()
    {
        if($this->is_add_groupe){
            $this->is_add_groupe = false;
            // on vide le champ de saisie
            $this->new_groupe_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_groupe_name']);
        }else{
            $this->is_add_groupe = true;      
    }
    }
    // fonction de gestion de l'ajout de groupe(validation)
    public function add_new_groupe()
    {
        // s'assurer d'ajouter nom_groupe a protected $fillable dans la classe Groupe 
        $this->validate([
            'new_groupe_name' => 'required|min:2|max:50|unique:groupes,nom_groupe'
        ]);
        // ajout du groupe dans la base de données
        Groupe::create([
            "nom_groupe" => strtoupper($this->new_groupe_name)
        ]);
        // masquage du champ d'ajout de groupe
        $this->is_add_groupe = false;
        // réinitialisation du champ de saisie
        $this->new_groupe_name = "";
          //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Groupe ajouté avec succès!"]);
    }
    // edition du nom du groupe
    public function edit_groupe($id)
    {
        // récupération du groupe à éditer
        $groupe = Groupe::find($id);
        // envoie du groupe à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'groupe' => $groupe
        ]);
       
    }
    // update du nom du groupe
    public function update_groupe($id, $value_from_js){
        // récupération du groupe à modifier($value_from_js provient du js il
        //  est appeller value et new_groupe_value est la varriable public declarée un peut plus haut)
        $this->new_groupe_value = $value_from_js;
        // dump($this->new_groupe_value);
        // validation du groupe à modifier
        $validated = $this->validate([
            'new_groupe_value' => ["required","min:2","max:50", Rule::unique('groupes',"nom_groupe")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du groupe à éditer et faire le update
        Groupe::find($id)->update(["nom_groupe" => $validated["new_groupe_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Groupe mis à jour avec succès!"]);

    }
    // suppression du groupe
    // confimation de Suppression du groupe avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer le groupe $name!",
                'data'=>[
                    'groupe_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_groupe($id){
    Groupe::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Groupe supprimé avec succès"]);
   }
}

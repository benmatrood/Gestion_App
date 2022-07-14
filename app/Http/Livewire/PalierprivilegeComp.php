<?php

namespace App\Http\Livewire;
use App\Models\Palierprivilege;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class PalierprivilegeComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de palierprivilege
    public $is_add_palierprivilege = false;
    // pour récuprer la valeur du nom du palierprivilege à ajouter
    public $new_palierprivilege_name = "";
    public $new_palierprivilege_point = "";
    // pour recupérer la nouvel valeur du palierprivilege(pour la modification)
    public $new_palierprivilege_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_palierprivilege_name.required' => 'Le nom du palierprivilege est obligatoire et doit comporter au moins 2 caractères',
        'new_palierprivilege_name.unique' => 'Ce nom de palierprivilege existe déjà',
        'new_palierprivilege_name.min' => 'Le nom du palierprivilege doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des palierprivileges d'articles
        $data=[
            "palierprivileges" => Palierprivilege::latest()->where("nom_palierprivilege", "like", $search_criteria)->get()
        ];
        return view('livewire.palierprivileges.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de palierprivilege
    public function toggle_show_add_palierprivilege()
    {
        if($this->is_add_palierprivilege){
            $this->is_add_palierprivilege = false;
            // on vide le champ de saisie
            $this->new_palierprivilege_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_palierprivilege_name']);
        }else{
            $this->is_add_palierprivilege = true;      
    }
    }
    // fonction de gestion de l'ajout de palierprivilege(validation)
    public function add_new_palierprivilege()
    {
        // s'assurer d'ajouter nom_palierprivilege a protected $fillable dans la classe Palierprivilege 
        $this->validate([
            'new_palierprivilege_name' => 'required|min:2|max:50|unique:palierprivileges,nom_palierprivilege',
            'new_palierprivilege_point' => 'required|numeric|min:0',
        ]);
        // dump($this->new_palierprivilege_name, $this->new_palierprivilege_point);
        // ajout du palierprivilege dans la base de données
        Palierprivilege::create([
            "nom_palierprivilege" => $this->new_palierprivilege_name,
            "nombre_points" => $this->new_palierprivilege_point
        ]);
        // // masquage du champ d'ajout de palierprivilege
        $this->is_add_palierprivilege = false;
        // // réinitialisation des champs de saisie
        $this->new_palierprivilege_name = "";
        $this->new_palierprivilege_point = "";
        //   //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege ajouté avec succès!"]);
    }
    // edition du nom du palierprivilege
    public function edit_palierprivilege($id)
    {
        // récupération du palierprivilege à éditer
        $palierprivilege = Palierprivilege::find($id);
        // envoie du palierprivilege à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'palierprivilege' => $palierprivilege
        ]);
       
    }
    // update du nom du palierprivilege
    public function update_palierprivilege($id, $value_from_js){
        // récupération du palierprivilege à modifier($value_from_js provient du js il
        //  est appeller value et new_palierprivilege_value est la varriable public declarée un peut plus haut)
        $this->new_palierprivilege_value = $value_from_js;
        // dump($this->new_palierprivilege_value);
        // validation du palierprivilege à modifier
        $validated = $this->validate([
            'new_palierprivilege_value' => ["required","min:2","max:50", Rule::unique('palierprivileges',"nom_palierprivilege")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du palierprivilege à éditer et faire le update
        Palierprivilege::find($id)->update(["nom_palierprivilege" => $validated["new_palierprivilege_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege mis à jour avec succès!"]);

    }
    // suppression du palierprivilege
    // confimation de Suppression du palierprivilege avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer le palierprivilege $name!",
                'data'=>[
                    'palierprivilege_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_palierprivilege($id){
    Palierprivilege::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege supprimé avec succès"]);
   }
}

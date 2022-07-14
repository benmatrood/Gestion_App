<?php

namespace App\Http\Livewire;
use App\Models\Famille;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class FamilleComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de famille
    public $is_add_famille = false;
    // pour récuprer la valeur du nom du famille à ajouter
    public $new_famille_name = "";
    // pour recupérer la nouvel valeur du famille(pour la modification)
    public $new_famille_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_famille_name.required' => 'Le nom du famille est obligatoire et doit comporter au moins 2 caractères',
        'new_famille_name.unique' => 'Ce nom de famille existe déjà',
        'new_famille_name.min' => 'Le nom du famille doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des familles d'articles
        $data=[
            "familles" => Famille::latest()->where("nom_famille", "like", $search_criteria)->get()
        ];
        return view('livewire.familles.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de famille
    public function toggle_show_add_roupe()
    {
        if($this->is_add_famille){
            $this->is_add_famille = false;
            // on vide le champ de saisie
            $this->new_famille_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_famille_name']);
        }else{
            $this->is_add_famille = true;      
    }
    }
    // fonction de gestion de l'ajout de famille(validation)
    public function add_new_famille()
    {
        // s'assurer d'ajouter nom_famille a protected $fillable dans la classe Famille 
        $this->validate([
            'new_famille_name' => 'required|min:2|max:50|unique:familles,nom_famille'
        ]);
        // ajout du famille dans la base de données
        Famille::create([
            "nom_famille" => $this->new_famille_name
        ]);
        // masquage du champ d'ajout de famille
        $this->is_add_famille = false;
        // réinitialisation du champ de saisie
        $this->new_famille_name = "";
          //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Famille ajouté avec succès!"]);
    }
    // edition du nom du famille
    public function edit_famille($id)
    {
        // récupération du famille à éditer
        $famille = Famille::find($id);
        // envoie du famille à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'famille' => $famille
        ]);
       
    }
    // update du nom du famille
    public function update_famille($id, $value_from_js){
        // récupération du famille à modifier($value_from_js provient du js il
        //  est appeller value et new_famille_value est la varriable public declarée un peut plus haut)
        $this->new_famille_value = $value_from_js;
        // dump($this->new_famille_value);
        // validation du famille à modifier
        $validated = $this->validate([
            'new_famille_value' => ["required","min:2","max:50", Rule::unique('familles',"nom_famille")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du famille à éditer et faire le update
        Famille::find($id)->update(["nom_famille" => $validated["new_famille_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Famille mis à jour avec succès!"]);

    }
    // suppression du famille
    // confimation de Suppression du famille avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer la famille $name!",
                'data'=>[
                    'famille_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_famille($id){
    Famille::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Famille supprimé avec succès"]);
   }
}

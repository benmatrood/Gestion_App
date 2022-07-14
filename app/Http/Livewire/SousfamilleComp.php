<?php

namespace App\Http\Livewire;
use App\Models\Sousfamille;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;






class SousfamilleComp extends Component
{
    // variable de stockage pour le filtre de recherche
    public $search= "";
    // variable d'écoute pour récupérer l'action de click sur le bouton d'ajout de sousfamille
    public $is_add_sousfamille = false;
    // pour récuprer la valeur du nom du sousfamille à ajouter
    public $new_sousfamille_name = "";
    // pour recupérer la nouvel valeur du sousfamille(pour la modification)
    public $new_sousfamille_value = "";
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_sousfamille_name.required' => 'Le nom du sousfamille est obligatoire et doit comporter au moins 2 caractères',
        'new_sousfamille_name.unique' => 'Ce nom de sousfamille existe déjà',
        'new_sousfamille_name.min' => 'Le nom du sousfamille doit comporter au moins 2 caractères',
      
    ];
    // fonction principal
    public function render()
    {
        // Avoir le rendu en francais
        Carbon::setLocale('fr');
        $search_criteria = "%".$this->search;
        // recherche des sousfamilles d'articles
        $data=[
            "sousfamilles" => Sousfamille::latest()->where("nom_sousfamille", "like", $search_criteria)->get()
        ];
        return view('livewire.sousfamilles.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }
    // fonction de gestion d'affichage ou de masquage du champ d'ajout de sousfamille
    public function toggle_show_add_roupe()
    {
        if($this->is_add_sousfamille){
            $this->is_add_sousfamille = false;
            // on vide le champ de saisie
            $this->new_sousfamille_name = "";
            // on vide le message d'erreur
            $this->resetErrorBag(['new_sousfamille_name']);
        }else{
            $this->is_add_sousfamille = true;      
    }
    }
    // fonction de gestion de l'ajout de sousfamille(validation)
    public function add_new_sousfamille()
    {
        // s'assurer d'ajouter nom_sousfamille a protected $fillable dans la classe Sousfamille 
        $this->validate([
            'new_sousfamille_name' => 'required|min:2|max:50|unique:sousfamilles,nom_sousfamille'
        ]);
        // ajout du sousfamille dans la base de données
        Sousfamille::create([
            "nom_sousfamille" => $this->new_sousfamille_name
        ]);
        // masquage du champ d'ajout de sousfamille
        $this->is_add_sousfamille = false;
        // réinitialisation du champ de saisie
        $this->new_sousfamille_name = "";
          //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Sousfamille ajouté avec succès!"]);
    }
    // edition du nom du sousfamille
    public function edit_sousfamille($id)
    {
        // récupération du sousfamille à éditer
        $sousfamille = Sousfamille::find($id);
        // envoie du sousfamille à la vue dans le popup sweetalert
        $this->dispatchBrowserEvent('show_edit_form', [
            'sousfamille' => $sousfamille
        ]);
       
    }
    // update du nom du sousfamille
    public function update_sousfamille($id, $value_from_js){
        // récupération du sousfamille à modifier($value_from_js provient du js il
        //  est appeller value et new_sousfamille_value est la varriable public declarée un peut plus haut)
        $this->new_sousfamille_value = $value_from_js;
        // dump($this->new_sousfamille_value);
        // validation du sousfamille à modifier
        $validated = $this->validate([
            'new_sousfamille_value' => ["required","min:2","max:50", Rule::unique('sousfamilles',"nom_sousfamille")->ignore($id)]
        ]);
        // dump($validated);
        // récupération du sousfamille à éditer et faire le update
        Sousfamille::find($id)->update(["nom_sousfamille" => $validated["new_sousfamille_value"]]);

        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Sousfamille mis à jour avec succès!"]);

    }
    // suppression du sousfamille
    // confimation de Suppression du sousfamille avec un modal swaljs de confirmation
    public function confim_delete($name, $id){
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_confim_delete_message', [
            'message'=>[
                'text'=>"Vous êtes sur le point de supprimer la sousfamille $name!",
                'data'=>[
                    'sousfamille_id'=>$id,]  
            ]
        ]);
    }
    // function de suppression d'un utilisateur
   public function delete_sousfammille($id){
    Sousfamille::destroy($id);
    // créer un message de confirmation de supression(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
    $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Sousfamille supprimé avec succès"]);
   }
}

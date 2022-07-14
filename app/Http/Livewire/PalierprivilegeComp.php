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
    // variable d'écoute pour récupérer l'action de click sur le bouton de modification du palierprivilege
    public $is_edit_palierprivilege = false;
    // pour récuprer la valeur du nom du palierprivilege à ajouter
    public $new_palierprivilege_name = "";
    public $new_palierprivilege_point = "";
    // pour récuprer la valeur du nom du palierprivilege à modifier
    public $edit_palierprivilege = [];
    // pour récuprer les valeur du nom du palierprivilege à editer
    public $edit_palierprivilege_name = "";
    public $edit_palierprivilege_point = "";
    // pour recupérer la nouvel valeur du palierprivilege(pour la modification)
    public $new_palierprivilege_value = "";

    // création des rules pour le formulaire d'édition
    public function rules()
    {
        return [
            'edit_palierprivilege_name' => ['required', 'string', 'max:255'],
            'edit_palierprivilege_point' => ['required', 'string', 'max:255'],
        ];
    }
    // message d'erreur du formulaire d'ajout d'utilisateurs
    protected $messages= [
        'new_palierprivilege_name.required' => 'Le nom doit comporter au moins 2 caractères',
        'new_palierprivilege_name.unique' => 'Ce nom de palierprivilege existe déjà',
        'new_palierprivilege_name.min' => 'Le nom doit comporter au moins 2 caractères',
        'edit_palierprivilege_name.required' => 'Le nom doit comporter au moins 2 caractères',
        'edit_palierprivilege_name.unique' => 'Ce nom de palierprivilege existe déjà',
        'edit_palierprivilege_name.min' => 'Le nom doit comporter au moins 2 caractères',
        'edit_palierprivilege_point.required' => 'Le point est obligatoire',
        'edit_palierprivilege_point.min' => 'Le point doit comporter au moins 2 caractères',
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
            $this->is_add_palierprivilege = true;}
        
    }
     // fonction de gestion d'affichage ou de masquage du champ de modification du palier privilege
     public function toggle_show_edit_palierprivilege()
     {
         if($this->is_edit_palierprivilege){
             $this->is_edit_palierprivilege = false;
             // on vide les champs de saisie
             $this->edit_palierprivilege_name = "";
             $this->edit_palierprivilege_point = "";
             // on vide les messages d'erreur
             $this->resetErrorBag(['edit_palierprivilege_name']);
             $this->resetErrorBag(['edit_palierprivilege_point']);
         }else{
             $this->is_edit_palierprivilege = true;}
            // on récupère le palierprivilege à modifier
        
     }

     
    // récupérer les données de l'utilisateur à éditer dans le tableau edit_user
    public function go_to_edit_palierprivilege($id){
        $this->edit_palierprivilege = Palierprivilege::find($id)->toArray();
        $this->toggle_show_edit_palierprivilege();
        // dump($this->edit_palierprivilege);

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
            "nom_palierprivilege" => strtoupper($this->new_palierprivilege_name),
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



    // edition du nom et du nombre de point du palierprivilege
    public function update_palierprivilege(){
        dump($this->edit_palierprivilege);
        $this->edit_palierprivilege_name = $this->edit_palierprivilege['nom_palierprivilege'];
        $this->edit_palierprivilege_point = $this->edit_palierprivilege['nombre_points'];
        // s'assurer d'ajouter nom_palierprivilege a protected $fillable dans la classe Palierprivilege 
        $this->validate([
            'edit_palierprivilege_name' => "required","nom_palierprivilege",Rule::unique("palierprivileges","nom_palierprivilege")->ignore($this->edit_palierprivilege['id']),
            'edit_palierprivilege_point' => 'required|numeric|min:0',
        ]);
        dump($this->edit_palierprivilege_name, $this->edit_palierprivilege_point);
        // // dump($this->edit_palierprivilege_name, $this->edit_palierprivilege_point);
        // // modification du palierprivilege dans la base de données
        // Palierprivilege::where("id_palierprivilege", $this->edit_palierprivilege["id"])
        // ->update([
        //     "nom_palierprivilege" => strtoupper($this->edit_palierprivilege_name),
        //     "nombre_points" => $this->edit_palierprivilege_point
        // ]);
        // // // masquage du champ de modification du palierprivilege
        // $this->is_edit_palierprivilege = false;
        // // // réinitialisation des champs de saisie
        // $this->edit_palierprivilege_name = "";
        // $this->edit_palierprivilege_point = "";
        // //   //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        //   $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege modifié avec succès!"]);
        // editer l'utilisateur dans la base de données
        Palierprivilege::find($this->edit_palierprivilege["id"])->update($this->edit_palierprivilege);   
        // dump($this->edit_palierprivilege);
         // // masquage du champ de modification du palierprivilege
        $this->is_edit_palierprivilege = false;
        // // réinitialisation des champs de saisie
        $this->edit_palierprivilege_name = "";
        $this->edit_palierprivilege_point = "";
        // //   //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
          $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege modifié avec succès!"]);
        
    }





      // Mise a jour de l'utilisateur
      public function update_user(){
        // s'assurer d'ajouter nom_palierprivilege a protected $fillable dans la classe Palierprivilege 
        $this->validate([
            'edit_palierprivilege_name' => 'required|min:2|max:50',
            'edit_palierprivilege_point' => 'required|numeric|min:1',
        ]);
                // editer l'utilisateur dans la base de données
        User::find($this->edit_user["id"])->update($validatedData['edit_user']);
        // vider le formulaire d'édition d'utilisateurs
        $nom = $this->edit_user["nom_user"];
        $prenom = $this->edit_user["prenom_user"];
        $name = $nom." ".$prenom;
        //créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Les information de $name ont été mis à jour avec succès"]);
    }



    // update data palierprivilege
    public function edit_palierprivilege($id)
    {
        // récupération du palierprivilege à modifier
        $palierprivilege = Palierprivilege::find($id);
        // validation des données
        $this->validate([
            'edit_palierprivilege_name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('palierprivileges')->ignore($palierprivilege->id),
            ],
            'edit_palierprivilege_point' => 'required|numeric|min:0',
        ]);
        // update du palierprivilege dans la base de données
        $palierprivilege->update([
            "nom_palierprivilege" => strtoupper($this->edit_palierprivilege_name),
            "nombre_points" => $this->edit_palierprivilege_point
        ]);
        // masquage du champ de modification du palierprivilege
        $this->is_edit_palierprivilege = false;
        // réinitialisation des champs de saisie
        $this->edit_palierprivilege_name = "";
        $this->edit_palierprivilege_point = "";
        // créer un message de confirmation(envoie un message flash au navigateur tu l'intercepte et l'affiche dans la vue)
        $this->dispatchBrowserEvent('show_succes_message', ['message'=>"Palierprivilege modifié avec succès!"]);
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

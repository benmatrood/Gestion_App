<div class="p-5">
    <div class="" style="margin:0 5rem 0 5rem;">
        <div>
            <div class="card">
                <div class="card-header" style="background-color: #4c1661;color: #fff;">
                    <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> <strong>Ajouter un nouvel
                            utilisateur</strong>
                    </h3>
                </div>
                <form   wire:submit.prevent="add_user" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" wire:model="new_user.nom_user" class="form-control  @error('new_user.nom_user') is-invalid @enderror">
                                    @error('new_user.nom_user') <samp>{{$message}}</samp> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input type="text" class="form-control @error('new_user.prenom_user') is-invalid @enderror" wire:model="new_user.prenom_user">
                                    @error('new_user.prenom_user') <samp>{{$message}}</samp> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Civilité</label>
                            <select class="form-control @error('new_user.sexe_user') is-invalid @enderror" wire:model="new_user.sexe_user">
                                <option value="">--------</option>
                                <option value="M">Monsieur</option>
                                <option value="f">Madame</option>
                            </select>
                            @error('new_user.sexe_user') <samp>{{$message}}</samp> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('new_user.email') is-invalid @enderror" wire:model="new_user.email">
                            @error('new_user.email') <samp>{{$message}}</samp> @enderror
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" class="form-control" placeholder="password" disabled> 
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label>Boutique</label>
                            <select class="form-control @error('new_user.boutique_id') is-invalid @enderror" wire:model="new_user.boutique_id">
                                <option value="">--------</option>
                                <option value="1">Boutique</option>
                                <option value="2">Cap Sud</option>
                                <option value="3">Cap Nord</option> 
                                <option value="4">Cosmos</option>
                                <option value="5">Rue des jarrdin</option>
                            </select>
                            @error('new_user.boutique_id') <samp>{{$message}}</samp> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #4c1661;color: #fff;">Enregistrer</button>
                        <button type="button" wire:click="go_to_user_list()" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

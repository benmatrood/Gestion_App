{{-- <div class="p-5">
    <div class="" style="margin:0 5rem 0 5rem;">
        <div>
            <div class="card">
                <div class="card-header" style="background-color: #10038f;color: #fff;">
                    <h3 class="card-title"> <i class="fas fa-user-plus fa-2x"></i> <strong>Ajouter un nouvel
                            article</strong>
                    </h3>
                </div>
                <form   wire:submit.prevent="add_user" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" wire:model="new_article.nom_user" class="form-control  @error('new_article.nom_user') is-invalid @enderror">
                                    @error('new_article.nom_user') <samp>{{$message}}</samp> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Prénom</label>
                                    <input type="text" class="form-control @error('new_article.prenom_user') is-invalid @enderror" wire:model="new_article.prenom_user">
                                    @error('new_article.prenom_user') <samp>{{$message}}</samp> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Civilité</label>
                            <select class="form-control @error('new_article.sexe_user') is-invalid @enderror" wire:model="new_article.sexe_user">
                                <option value="">--------</option>
                                <option value="M">Monsieur</option>
                                <option value="f">Madame</option>
                            </select>
                            @error('new_article.sexe_user') <samp>{{$message}}</samp> @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control @error('new_article.email') is-invalid @enderror" wire:model="new_article.email">
                            @error('new_article.email') <samp>{{$message}}</samp> @enderror
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
                            <select class="form-control @error('new_article.boutique_id') is-invalid @enderror" wire:model="new_article.boutique_id">
                                <option value="">--------</option>
                                <option value="1">Boutique</option>
                                <option value="2">Cap Sud</option>
                                <option value="3">Cap Nord</option> 
                                <option value="4">Cosmos</option>
                                <option value="5">Rue des jarrdin</option>
                            </select>
                            @error('new_article.boutique_id') <samp>{{$message}}</samp> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #10038f;color: #fff;">Enregistrer</button>
                        <button type="button" wire:click="go_to_user_list()" class="btn btn-danger">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}


<div class="">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="col-12 mt-4">
                <div class="card mr-4 ml-3">
                    <div class="card-header" style="background-color: #4c1661;color: #fff; font-weight: 900;">
                        <h3 class="card-title" style="font-weight: 900;"> <i class="fas fa-user-plus fa-2x "></i>
                            <strong>Ajouter un 
                                article</strong>
                        </h3>
                    </div>
                    <form wire:submit.prevent="add_article">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Label et Référence -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Labèle</label>
                                                <input type="text" wire:model="new_article.nom_article"
                                                    class="form-control  @error('new_article.nom_article') is-invalid @enderror">
                                                @error('new_article.nom_article') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Référence</label>
                                                <input type="text"
                                                    class="form-control @error('new_article.reference_article') is-invalid @enderror"
                                                    wire:model="new_article.reference_article">
                                                @error('new_article.reference_article') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description et stock -->
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                            <label>Description</label>
                                            <textarea wire:model="new_article.despription" class="form-control @error('new_article.despription') is-invalid @enderror" rows="7" placeholder="Enter le description ..."></textarea>
                                            </div>
                                        </div>
                                            @error('new_article.despription') <samp>{{$message}}</samp> @enderror
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="number"
                                                    class="form-control @error('new_article.stock') is-invalid @enderror"
                                                    wire:model="new_article.stock">
                                                @error('new_article.stock') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- groupe et Famille -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Groupe</label>
                                                <select
                                                    class="form-control @error('new_article.groupe_id') is-invalid @enderror"
                                                    wire:model="new_article.groupe_id">
                                                    <option value="">--------</option>
                                                    @foreach ($groupes as $groupe)
                                                    <option value="{{$groupe->id}}">{{$groupe->nom_groupe}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('new_article.groupe_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Famille</label>
                                                <select
                                                    class="form-control @error('new_article.famille_id') is-invalid @enderror"
                                                    wire:model="new_article.famille_id">
                                                    <option value="">--------</option>
                                                    @foreach ($familles as $famille)
                                                    <option value="{{$famille->id}}">{{$famille->nom_famille}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('new_article.famille_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sous Famille et Palier Privilège -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Sous Famille</label>
                                                <select
                                                    class="form-control @error('new_article.sousfamille_id') is-invalid @enderror"
                                                    wire:model="new_article.sousfamille_id">
                                                    <option value="">--------</option>
                                                    @foreach ($sousfamilles as $sousfamille)
                                                    <option value="{{$sousfamille->id}}">{{$sousfamille->nom_sousfamille}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('new_article.famille_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Palier Privilège</label>
                                                <select
                                                    class="form-control @error('new_article.palierprivilege_id') is-invalid @enderror"
                                                    wire:model="new_article.palierprivilege_id">
                                                    <option value="">--------</option>
                                                    @foreach ($palierprivileges as $palierprivilege)
                                                    <option value="{{$palierprivilege->id}}">{{$palierprivilege->nom_palierprivilege}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('new_article.palierprivilege_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ml-5">
                                       <div class="p'4">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" wire:model="url_image"
                                                    class="form-control @error('new_article.url_image') is-invalid @enderror">
                                                @error('new_article.url_image') <samp>{{$message}}</samp> @enderror
                                            </div>
                                            <div style="border: 1px solid #d0d1d3;border-radius:20px;height: 50vh;">
                                                <img src="" alt="">
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #4c1661;color: #fff;">Enregistrer cette
                                article</button>
                            <button type="button" wire:click="go_to_user_list()" class="btn btn-danger">Retour à la
                                liste des articles</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

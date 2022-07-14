<div class="">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="col-12 mt-4">
                <div class="card mr-4 ml-3">
                    <div class="card-header" style="background-color: #4c1661;color: #fff; font-weight: 900;">
                        <h3 class="card-title" style="font-weight: 900;"> <i class="fas fa-user-plus fa-2x "></i>
                            <strong>Modifier les
                                articles</strong>
                        </h3>
                    </div>
                    <form wire:submit.prevent="update_article()">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <!-- Label et Référence -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Labèle</label>
                                                <input type="text" wire:model="edit_article.nom_article"
                                                    class="form-control  @error('edit_article.nom_user') is-invalid @enderror">
                                                @error('edit_article.nom_user') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Référence</label>
                                                <input type="text"
                                                    class="form-control @error('edit_article.reference_article') is-invalid @enderror"
                                                    wire:model="edit_article.reference_article">
                                                @error('edit_article.reference_article') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description et stock -->
                                    <div class="row">
                                        <div class="col-12">

                                            <div class="form-group">
                                            <label>Description</label>
                                            <textarea wire:model="edit_article.despription" class="form-control @error('edit_article.nom_user') is-invalid @enderror" rows="7" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                            @error('edit_article.nom_user') <samp>{{$message}}</samp> @enderror
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Stock</label>
                                                <input type="number"
                                                    class="form-control @error('edit_article.prenom_user') is-invalid @enderror"
                                                    wire:model="edit_article.stock">
                                                @error('edit_article.prenom_user') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- groupe et Famille -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Groupe</label>
                                                <select
                                                    class="form-control @error('edit_article.boutique_id') is-invalid @enderror"
                                                    wire:model="edit_article.groupe_id">
                                                    <option value="">--------</option>
                                                    @foreach ($groupes as $groupe)
                                                    <option value="{{$groupe->id}}">{{$groupe->nom_groupe}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('edit_article.groupe_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Famille</label>
                                                <select
                                                    class="form-control @error('edit_article.famille_id') is-invalid @enderror"
                                                    wire:model="edit_article.famille_id">
                                                    <option value="">--------</option>
                                                    @foreach ($familles as $famille)
                                                    <option value="{{$famille->id}}">{{$famille->nom_famille}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('edit_article.famille_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sous Famille et Palier Privilège -->
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Sous Famille</label>
                                                <select
                                                    class="form-control @error('edit_article.sousfamille_id') is-invalid @enderror"
                                                    wire:model="edit_article.sousfamille_id">
                                                    <option value="">--------</option>
                                                    @foreach ($sousfamilles as $sousfamille)
                                                    <option value="{{$sousfamille->id}}">{{$sousfamille->nom_sousfamille}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('edit_article.famille_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Palier Privilège</label>
                                                <select
                                                    class="form-control @error('edit_article.palierprivilege_id') is-invalid @enderror"
                                                    wire:model="edit_article.palierprivilege_id">
                                                    <option value="">--------</option>
                                                    @foreach ($palierprivileges as $palierprivilege)
                                                    <option value="{{$palierprivilege->id}}">{{$palierprivilege->nom_palierprivilege}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('edit_article.palierprivilege_id') <samp>{{$message}}</samp> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="ml-5">
                                       <div class="p'4">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" wire:model="edit_article.url_image"
                                                    class="form-control @error('edit_article.url_image') is-invalid @enderror">
                                                @error('edit_article.url_image') <samp>{{$message}}</samp> @enderror
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
                                style="background-color: #4c1661;color: #fff;">Modifier les informations de
                                article</button>
                            <button type="button" wire:click="go_to_user_list()" class="btn btn-danger">Retourner à la
                                liste des articles</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="">
    <div class="row">
        <div class="col-6 mt-4">
            <div class="col-12">
                <div class="card mr-4 ml-3">
                    <div class="card-header" style="background-color: #4c1661;color: #fff;">
                        <h3 class="card-title"> <i class="fas fa-user-plus "></i> <strong>Modifier les
                                utilisateurs</strong>
                        </h3>
                    </div>
                    <form wire:submit.prevent="update_user()">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" wire:model="edit_user.nom_user"
                                            class="form-control  @error('edit_user.nom_user') is-invalid @enderror">
                                        @error('edit_user.nom_user') <samp>{{$message}}</samp> @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Prénom</label>
                                        <input type="text"
                                            class="form-control @error('edit_user.prenom_user') is-invalid @enderror"
                                            wire:model="edit_user.prenom_user">
                                        @error('edit_user.prenom_user') <samp>{{$message}}</samp> @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Civilité</label>
                                <select class="form-control @error('edit_user.sexe_user') is-invalid @enderror"
                                    wire:model="edit_user.sexe_user">
                                    <option value="">--------</option>
                                    <option value="M">Monsieur</option>
                                    <option value="f">Madame</option>
                                </select>
                                @error('edit_user.sexe_user') <samp>{{$message}}</samp> @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('edit_user.email') is-invalid @enderror"
                                    wire:model="edit_user.email">
                                @error('edit_user.email') <samp>{{$message}}</samp> @enderror
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
                                
                                <select class="form-control @error('edit_user.boutique_id') is-invalid @enderror"
                                    wire:model="edit_user.boutique_id">
                                    <option value="">--------</option>
                                    @foreach ($boutiques as $boutique)
                                    <option value="{{$boutique->id}}">{{$boutique->nom_boutique}}</option>
                                    @endforeach
                                </select>
                                
                                @error('edit_user.boutique_id') <samp>{{$message}}</samp> @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #4c1661;color: #fff;">Modifier les informations de utilisateur</button>
                            <button type="button" wire:click="go_to_user_list()" class="btn btn-danger">Retourner à la liste des utilisateurs</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Mot de passe -->
            
            <div class="col-12 mt-4">
                <div class="pt-4">
                <div class="card mr-4 ml-3 ">
                    <div class="card-header" style="background-color: #4c1661;color: #fff;">
                        <h3 class="card-title"> <i class="fas fa-key"></i> <strong>Réinitialiser le mot de
                                passe</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>
                                <a class="btn btn-link" wire:click.prevent="reset_default_password">Réinitialiser le
                                    mot de passe</a>
                                <span style="font-weight: 800;">(Le mot de passe par défaut est: "password")</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
             <!--End Mot de passe -->
        </div>
        <!-- gestion roles -->
        <div class="col-6 ">
            <div class="row">
                <div class="col-12 mt-4  ">
                    <div class="card mr-4">
                        <div class="card-header d-flex align-items-center" style="background-color: #4c1661;color: #fff;">
                            <h3 class="card-title flex-grow-1"> <i class="fas fa-fingerprint"></i> <strong>Gestion des Rôles &
                                    Permissions</strong>
                            </h3>
                            <button class="btn bg-gradient-success" wire:click="update_roles_and_permissions"><i class="fas fa-check"></i> Appliquer les modifications</button>
                        </div>
                        <div class="card-body">
                            <div class="accordion">
                                <!-- roles -->
                                @foreach ($user_roles_permissions['roles'] as $role)
                                <div class="pr-3 pl-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h4 class="card-title flex-grow-1">
                                                <a data-parent="#accordion" href="#"
                                                    aria-expanded="true">{{$role['role_name']}}</a>
                                            </h4>
                                            <div
                                                class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                <input type="checkbox" @if($role['active'])checked @endif
                                                    class="custom-control-input"
                                                    wire:model.lazy="user_roles_permissions.roles.{{$loop->index}}.active"
                                                    id="{{$role['role_name']}}">

                                                <label class="custom-control-label" for="{{$role['role_name']}}">{{$role['active']? "Activé" :
                                                    "Désactivé"}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <!-- end roles -->
                                <!-- permissions -->
                                <!-- <div class="pr-3 pl-3 ">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Permissions</th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($user_roles_permissions['permissions'] as $permission)
                                            <tr>
                                                <td>{{$permission['permission_name']}}</td>
                                                <td>
                                                    <div
                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox"
                                                            wire:model.lazy="user_roles_permissions.permissions.{{$loop->index}}.active"
                                                            class="custom-control-input"
                                                            @if($permission['active'])checked @endif
                                                            id="customSwitch{{$permission['permission_id']}}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch{{$permission['permission_id']}}">{{$permission['active']?
                                                            "Activé" : "Désactivé"}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div> -->
                                <!-- end permission -->
                                <!-- test -->
                                <div class="row">
                                        <div class="col-12  ">
                                            <div class="pr-3 pl-3">
                                            <div class="card" style="height: 42vh;">
                                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                                    <table class="table table-head-fixed text-nowrap">
                                                        <thead>
                                                            <th style="width:80%">Permissions</th>
                                                            <th></th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user_roles_permissions['permissions'] as $permission)
                                                            <tr>
                                                                <td>{{$permission['permission_name']}}</td>
                                                                <td>
                                                                    <div
                                                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                    <input type="checkbox"
                                                                        wire:model.lazy="user_roles_permissions.permissions.{{$loop->index}}.active"
                                                                        class="custom-control-input"
                                                                        @if($permission['active'])checked @endif
                                                                        id="customSwitch{{$permission['permission_id']}}">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch{{$permission['permission_id']}}">{{$permission['active']?
                                                                        "Activé" : "Désactivé"}}
                                                                    </label>
                                                                </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end test -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

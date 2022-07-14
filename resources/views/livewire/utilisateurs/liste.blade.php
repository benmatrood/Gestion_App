<div class="row p-4 pt-5 ">
    <div class="col-12">
        <div class="card" style="height: 75vh;">
            <div class="card-header " style="background-color: #4c1661;color: #fff;">
                <h3 class="card-title"> <i class="fas fa-users fa-2x"></i> Listes des utilisateurs</h3>
                <div class="card-tools d-flex align-items-center">
                    <a href="#" class="btn btn-link text-white mr-4 d-block"  wire:click.prevent="go_to_add_user()">
                        <i class="fas fa-user-plus icon"></i>
                        Ajouter Utilisateurs</a>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" name="table_search" class="form-control float-right"
                            placeholder="Recherche..." wire:model.debounce.250ms="search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th style="width:5%"></th>
                            <th style="width:20%">Utilisateurs</th>
                            <th style="width:20%">Rôle</th>
                            <th style="width:20%">Boutique</th>
                            <th style="width:20%" class="text-center">Date d'ajout</th>
                            <th style="width:15%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                @if($user->sexe_user=="M")
                                <img src="{{asset('images/homme.png')}}" alt="user" class="img-circle" width="25px">
                                @else
                                <img src="{{asset('images/femme.png')}}" alt="user" class="img-circle" width="25px">
                                @endif
                            </td>
                            <td>{{$user->nom_user}} {{$user->prenom_user}}</td>
                            <!-- AllRoleName est un getter definis ds le model User -->
                            <td>{{$user->AllRoleNames}}</td>
                            <td>{{$user->r_user_boutique->nom_boutique}}</td>
                            <td class="text-center"><span
                                    class="tag tag-success">{{$user->created_at->diffForHumans()}}</span></td>
                            <td class="text-center">
                                <button class="btn btn-link" wire:click ="go_to_edit_user('{{$user->id}}')"><i class="far fa-edit"></i></button>
                                <button class="btn btn-link" wire:click="confim_delete('{{$user->nom_user}} {{$user->prenom_user}}',{{$user->id}})"><i
                                        class="fas fa-trash-alt" style="color:red ;"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>

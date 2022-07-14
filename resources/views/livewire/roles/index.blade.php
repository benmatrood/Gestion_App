<div>
    <div class="row p-4 pt-5 ">
        <div class="col-12">
            <div class="card" style="height: 55vh;margin-right: 8rem;margin-left:8rem;">
                <div class="card-header "  style="background-color: #f8f9fa;color: #4c1661; font-weight: 900;">
                    <h3 class="card-title d-flex align-items-center"> <i class="fa fa-list fa-2x"><span
                                class="mr-2"></span></i> Listes des roles d'articles</h3>
                    <div class="card-tools d-flex align-items-center">
                        <a href="#" wire:click="toggle_show_add_role" class="btn btn-link text-white mr-4 d-block">
                            <i class="fas fa-user-plus icon"></i>
                            Ajouter un nouveau role d'articles</a>
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="table_search" wire:model.debounce.250ms="search"
                                class="form-control float-right" placeholder="Recherche...">
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
                                <th style="width:3%"></th>
                                <th style="width:32%">roles d'articles</th>
                                <th style="width:32%" class="text-center">Date d'ajout</th>
                                <th style="width:32%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($is_add_role)
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <input class="form-control @error('new_role_name') is-invalid @enderror"
                                        type="text" wire:model.lazy="new_role_name"
                                        wire:keydown.enter="add_new_role">
                                    @error('new_role_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" style="color:green ;" wire:click="add_new_role"><i
                                            class="fa fa-check"> Valider</i> </button>
                                    <button class="btn btn-link" style="color:red ;"
                                        wire:click="toggle_show_add_role"><i class="fas fa-trash-alt"> </i>
                                        Annuler</button>
                                </td>
                            </tr>
                            @endif
                            @foreach ($roles as $role)
                            <tr>
                                <td></td>
                                <td>{{$role->nom_role}}</td>
                                <td class="text-center">{{optional($role->created_at)->diffForHumans()}}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="edit_role({{$role->id}})"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-link" wire:click="confim_delete('{{$role->nom_role}}',{{$role->id}})"><i class="fas fa-trash-alt"
                                            style="color:red ;"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <!-- ajout de la pagination -->
                    <div class="float-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//    ajout de scripte pour intercepter le message de succès avecc sweetalert 
    window.addEventListener('show_edit_form', function (e) {
        Swal.fire({
            title: "Modifier le role d'articles",
            input: 'text',
            inputValue: e.detail.role.nom_role,
            showCancelButton: true,
            confirmButtonColor: '#10038f ',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Modifier <i class="fa fa-check"></i>',
            cancelButtonText: 'Annuler <i class="fa fa-times"></i>',
            inputValidator: (value) => {
                // si le champ est vide
                if (!value) {
                    return 'Ce champ ne peut être vide!'
                }
                // si le champ est renseigné on apple la fonction de validation
                //  du role d'articles a l'intérieur du js. la function update_role est créer ds le composant role
                else {
                    @this.update_role(e.detail.role.id, value)

                }
            }
        })
    })
    // message de confirmation de mise a jour du role d'articles
    window.addEventListener('show_succes_message', event => {
        Swal.fire({
            position: 'top-end',
            title: event.detail.message,
            toast: 'true',
            icon: 'success',
            showConfirmButton: false,
            timer: 5000
        })
    })
    // Suppression du role d'articles
    window.addEventListener('show_confim_delete_message', event => {
        Swal.fire({
            title: 'Êtes vous sur de continuer?',
            text: event.detail.message.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#10038f',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer',
            cancelButtonText: 'Annuler', 
        }).then((result) => {
            if (result.isConfirmed) {
                // on appelle la methode delete_user de la class livewire
                // on passe des données php ds du js grace  a livewire
                @this.delete_role(event.detail.message.data.role_id)
            }
        })
    })

</script>
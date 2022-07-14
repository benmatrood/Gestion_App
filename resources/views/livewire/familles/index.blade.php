<div>
    <div class="row p-4 pt-5 ">
        <div class="col-12">
            <div class="card" style="height: 55vh;margin-right: 8rem;margin-left:8rem;">
                <div class="card-header " style="background-color: #10038f;color: #fff;">
                    <h3 class="card-title d-flex align-items-center"> <i class="fa fa-list fa-2x"><span
                                class="mr-2"></span></i> Listes des familles d'articles</h3>
                    <div class="card-tools d-flex align-items-center">
                        <a href="#" wire:click="toggle_show_add_roupe" class="btn btn-link text-white mr-4 d-block">
                            <i class="fas fa-user-plus icon"></i>
                            Ajouter une nouvelle famille d'articles</a>
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
                                <th style="width:32%">Familles d'articles</th>
                                <th style="width:32%" class="text-center">Date d'ajout</th>
                                <th style="width:32%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($is_add_famille)
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <input class="form-control @error('new_famille_name') is-invalid @enderror"
                                        type="text" wire:model.lazy="new_famille_name"
                                        wire:keydown.enter="add_new_famille">
                                    @error('new_famille_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" style="color:green ;" wire:click="add_new_famille"><i
                                            class="fa fa-check"> Valider</i> </button>
                                    <button class="btn btn-link" style="color:red ;"
                                        wire:click="toggle_show_add_roupe"><i class="fas fa-trash-alt"> </i>
                                        Annuler</button>
                                </td>
                            </tr>
                            @endif
                            @foreach ($familles as $famille)
                            <tr>
                                <td></td>
                                <td>{{$famille->nom_famille}}</td>
                                <td class="text-center">{{optional($famille->created_at)->diffForHumans()}}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click="edit_famille({{$famille->id}})"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-link" wire:click="confim_delete('{{$famille->nom_famille}}',{{$famille->id}})"><i class="fas fa-trash-alt"
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
            title: "Modifier la famille d'articles",
            input: 'text',
            inputValue: e.detail.famille.nom_famille,
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
                //  du famille d'articles a l'intérieur du js. la function update_famille est créer ds le composant famille
                else {
                    @this.update_famille(e.detail.famille.id, value)

                }
            }
        })
    })
    // message de confirmation de mise a jour du famille d'articles
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
    // Suppression du famille d'articles
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
                @this.delete_famille(event.detail.message.data.famille_id)
            }
        })
    })

</script>

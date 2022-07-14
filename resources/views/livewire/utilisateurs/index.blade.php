<div wire:ignore.self>
    <!-- affichage des page en function de la variable $current_page  -->
    @if($current_page == PAGECREATEFORM)
        <!-- inclure le formulaire de creation des utilisateurs -->
        @include('livewire.utilisateurs.create')
    @endif
    @if($current_page == PAGEEDITFORM)
        <!-- inclure le formulaire de modification des utilisateurs -->
        @include('livewire.utilisateurs.edit')
    @endif    
    @if($current_page == PAGELIST)
        <!-- inclure la page liste des utilisateur -->
        @include('livewire.utilisateurs.liste')
    @endif
</div>

<!-- ajout de scripte pour intercepter le message de succès avecc sweetalert -->
<script>
    window.addEventListener('show_confim_delete_message', event => {

        Swal.fire({
            title: 'Êtes vous sur de continuer?',
            text: event.detail.message.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuer',
            cancelButtonText: 'Annuler', 
        }).then((result) => {
            if (result.isConfirmed) {
                // on appelle la methode delete_user de la class livewire
                // on passe des données php ds du js grace  a livewire
                @this.delete_user(event.detail.message.data.user_id)
            }
        })
    })
    // message de confirmationde suppression d'un utilisateur
    window.addEventListener('show_succes_message', event=>{
      Swal.fire({
        position: 'top-end',
        title:event.detail.message ||'Utilisateur créer avec Succès',
        toast:'true',
        icon: 'success',
        showConfirmButton: false,
        timer: 5000
      })
    })

</script>
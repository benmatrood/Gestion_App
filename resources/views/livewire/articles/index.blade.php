<div wire:ignore.self>
    <!-- affichage des page en function de la variable $current_page  -->
    @if($current_page == PAGECREATEFORM)
        <!-- inclure le formulaire de creation des articles -->
        @include('livewire.articles.create')
    @endif
    @if($current_page == PAGEEDITFORM)
        <!-- inclure le formulaire de modification des articles -->
        @include('livewire.articles.edit')
    @endif    
    @if($current_page == PAGELIST)
        <!-- inclure la page liste des article -->
        @include('livewire.articles.liste')
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
                // on appelle la methode delete_article de la class livewire
                // on passe des données php ds du js grace  a livewire
                @this.delete_article(event.detail.message.data.article_id)
            }
        })
    })
    // message de confirmationde suppression d'un article
    window.addEventListener('show_succes_message', event=>{
      Swal.fire({
        position: 'top-end',
        title:event.detail.message ||'article créer avec Succès',
        toast:'true',
        icon: 'success',
        showConfirmButton: false,
        timer: 5000
      })
    })

</script>
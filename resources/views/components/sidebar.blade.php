<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="card-body box-profile">
      <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{asset('images/personne.png')}}"
              alt="User profile picture">
      </div>
      <h3 class="profile-username text-center ellipsis">{{user_full_name()}}</h3>
      <p class="text-muted text-center">{{get_user_role_name()}}</p>
      <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item  mb-3">
            <a href="#"class="d-flex align-items-center"> <i class="fa fa-lock pr-2 "><b class="ml-3">Mot de passe</b></i></a>
          </li>
          <li class="list-group-item  mb-3">
            <a href="#"class="d-flex align-items-center"> <i class=" fa fa-user pr-2"><b class="ml-3">Mon profile</b></i></a>
          </li>

      </ul>
      <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
       {{ __('Déconnexion') }}
       {{-- <b>Déconnexion</b> --}}
   </a>

   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
       @csrf
   </form>
      {{-- <a href="#" class="btn btn-primary btn-block"><b>Déconnexion</b></a> --}}
  </div>
  
      
  </aside>


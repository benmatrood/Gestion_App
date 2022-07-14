
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fr">
  {{-- Ajout de @livewireStyles --}}
  @livewireStyles
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ZINO CI</title>
  <link rel="icon" type="image/x-icon" href="{{asset('images/zino-circle-bg.svg')}}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
 <x-topnav/>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="/" class="brand-link">
      <span class="brand-text zino_logo">Catalogue Zino</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/LOGO_ZINO BLANC.png')}}" class="img-circle elevation-4" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ZINO CÔTE D'IVOIRE</a>
        </div>
      </div>     

      <!-- Sidebar Menu -->
    <x-menu/>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- ajouter contenu a partir de welcome--}}
        @yield('content')
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
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
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    <strong>La Passion Du Luxe Depuis Plus De 40 Ans !</strong>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="https://zino.ci">- ZINO</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Ajout du js -->
<script src="{{asset('js/app.js')}}"></script>
{{--Ajout de livewireScripts  --}}
@livewireScripts
</body>
</html>

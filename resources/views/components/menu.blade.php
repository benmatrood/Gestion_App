<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        {{-- Acceuil --}}
            <li class="nav-item">
                <a href="/" class="nav-link {{set_menu_active('home')}}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Acceuil
                    </p>
                </a>
            </li>
        {{-- Fin Acceuil --}}

        @can("admin")
        {{-- Tableau de bord --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Tableau de bord
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Vue Glogale</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-swatchbook nav-icon"></i>
                        <p>Rapport</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Fin Tableau de bord --}}
        @endcan
        @can("admin")
        {{-- Habilitations --}}
        <li class="nav-item {{set_menu_class('admin.habilitations.','menu-open')}}">
            <a href="#" class="nav-link  {{set_menu_class('admin.habilitations.','active')}}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Habilitations
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{set_menu_class('admin.habilitations.','block')}};">
                <li class="nav-item ">
                    <a href="{{route('admin.habilitations.users.index')}}" class="nav-link {{set_menu_active('admin.habilitations.users.index')}} ">
                        <i class="fas fa-users-cog nav-icon "></i>
                        <p>Utilisateurs </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-fingerprint nav-icon"></i>
                        <p>R??le et permissions</p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-fingerprint nav-icon"></i>
                        <p>R??le et permissions</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Fin Habilitations --}}
        @endcan

        @can("employer")
        {{-- gestion articles --}}
        <li class="nav-item {{set_menu_class('admin.gestarticles.','menu-open')}}">
            <a href="#" class="nav-link {{set_menu_class('admin.gestarticles.','active')}}">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Gestions Articles
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: {{set_menu_class('admin.gestarticles.','block')}}">
                <li class="nav-item">
                    <a href="{{route('admin.gestarticles.articles')}}" class="nav-link {{set_menu_active('admin.gestarticles.articles')}}">
                        <i class="far fa-circle fa-solid fa-newspaper nav-icon"></i>
                        {{-- <i class="fa-solid fa-newspaper"></i> --}}
                        <p>Articles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.gestarticles.groupes')}}" class="nav-link {{set_menu_active('admin.gestarticles.groupes')}}">
                        <i class="fa fa-layer-group nav-icon"></i>
                        <p>Groupes</p>
                        {{-- <i class="fa-solid fa-object-union"></i> --}}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.gestarticles.familles')}}" class="nav-link {{set_menu_active('admin.gestarticles.familles')}}">
                        <i class="far fa-circle fa-solid fa-object-union nav-icon"></i>
                        <p>Familles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.gestarticles.sousfamilles')}}" class="nav-link {{set_menu_active('admin.gestarticles.sousfamilles')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sous Familles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.gestarticles.palierprivileges')}}" class="nav-link {{set_menu_active('admin.gestarticles.palierprivileges')}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Paliers Privil??ges</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Fin gestion articles --}}
        @endcan

        @can("employer")
        {{--Gestions Commandes --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Gestions Commandes
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Commandes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>D??tails Commandes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>En cours</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Annuler</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Terminer</p>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Fin gestion Commandes --}}
        @endcan

        @can("manager")
        {{-- Gestion des clients --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Gestions clients
                </p>
            </a>
        </li>
        {{-- Fin gestion des clients --}}
        @endcan 

        {{-- Gestion des Param??tres --}}
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Param??tres
                </p>
            </a>
        </li>
        {{-- Fin Gestion des Param??tres--}}

    </ul>
  </nav>



  <style>
      [class*=sidebar-dark-] {
    background-color: #4c1661 !important;
}
control-sidebar-dark {
    background-color: #4c1661 !important;
}
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #00000059 !important;
    color: #fff;
}
[class*=sidebar-dark-] .sidebar a {
    color: #fff!important;
}


[class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
    background-color: #76797c63;
    color: #343a40;
}
  </style>
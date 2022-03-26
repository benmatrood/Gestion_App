<?php
// recupérer le nom complet du user
function user_full_name()
{
    return auth()->user()->nom_user." ".auth()->user()->prenom_user;
}

// recuperer les roles de l'utilisateur si il a plusieurs roles
function get_user_role_name()
{
    $roles_name="";
    $i=0;
    foreach (auth()->user()->r_user_role as $role) {
        $roles_name.=$role->nom_role;
        if($i<count(auth()->user()->r_user_role)-1)
        {
            $roles_name.=",";
        }
        $i++;
    }
    return $roles_name;
}
// récupérer le nom de la route de l'utilisateur
function set_menu_open($route)
{
   if(request()->route()->getName()===$route)
   {
       return "menu-open";
   }
    return "";

}
<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        @if(is_null($user))
            <title>Utilisateur</title>
        @else
            <title>{{$user->prenom}} {{$user->nom}} | Assistance Bot</title>
        @endif
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                @include("Layouts.top_navbar")
            </div>
            <div class="sidebar" id="sidebar">
                @include("Layouts.left_navbar")
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid mt-3">
                    <div class="page-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="page-title">Utilisateur</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Utilisateur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(is_null($user))
                                <div class = "alert alert-warning d-flex alert-dismissible fade show mt-1" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span class = "d-flex justify-content-start">
                                        Malheureusement, nous n'avons pas trouvé un utilisateur avec cette identifiant. Veuillez vérifier l'identifiant et réessayer plus tard.
                                    </span>
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                </div>
                            @else
                                <div class="profile-header">
                                    <div class="row align-items-center">
                                        <div class="col-auto profile-image">
                                            <a href="javascript:void(0)">
                                                <img class="rounded-circle" alt="Photo de profil" src="{{URL::asset($user->image)}}">
                                            </a>
                                        </div>
                                        <div class="col ms-md-n2 profile-user-info">
                                            <h4 class="user-name mb-0">{{$user->prenom}} {{$user->nom}}</h4>
                                            <h6 class="text-muted">{{$user->role}}</h6>
                                            <div class="user-Location">
                                                <i class="fa fa-mobile"></i>
                                                {{substr($user->mobile, 0, 2)." ".substr($user->mobile, 2, 3)." ".substr($user->mobile, 5, 3)}}
                                            </div>
                                            <div class="about-text text-capitalize"><?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($user->date_time_creation_user))))?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-menu">
                                    <ul class="nav nav-tabs nav-tabs-solid">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">À propos</a>
                                        </li>
                                        @if($user->role =="Client")

                                        <li class="nav-item">
                                            <a class="nav-link " data-bs-toggle="tab" href="#per_details_possede">Produit possédé</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-bs-toggle="tab" href="#per_details_ajout">Ajout Produit possédé</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="tab-content profile-tab-cont">
                                    <div class="tab-pane fade show active" id="per_details_tab">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title d-flex justify-content-between">
                                                            <span>Informations Personnelles</span>
                                                        </h5>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Nom :</p>
                                                            <p class="col-sm-9">{{$user->nom}}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Prenom :</p>
                                                            <p class="col-sm-9">{{$user->prenom}}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Adresse email :</p>
                                                            <p class="col-sm-9">
                                                                <a href = "javascript:void(0)" class="__cf_email__">
                                                                    [email&#160;protected]
                                                                </a>
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Genre :</p>
                                                            <p class="col-sm-9">{{$user->genre}}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Rôle :</p>
                                                            <p class="col-sm-9">{{$user->role}}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Numéro Mobile :</p>
                                                            <p class="col-sm-9">+216 {{substr($user->mobile, 0, 2)." ".substr($user->mobile, 2, 3)." ".substr($user->mobile, 5, 3)}}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Horaire De Création :</p>
                                                            <p class="col-sm-9"><?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($user->date_time_creation_user))))?> à {{date("H:i", strtotime($user->date_time_creation_user))}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title d-flex justify-content-between">
                                                            <span>Status De Compte</span>
                                                        </h5>
                                                        @if($user->status_compte == true)
                                                            <button class="btn btn-success" type="button">
                                                                <i class="fe fe-check-verified"></i>
                                                                Activé
                                                            </button>
                                                        @else
                                                            <button class="btn btn-danger" type="button">
                                                                <i class="fe fe-check-verified"></i>
                                                                Désactivé
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title d-flex justify-content-between">
                                                            <span>Autorisations </span>
                                                        </h5>
                                                        <div class="skill-tags">
                                                            @if($user->role == "Super Admin")
                                                                <span>Authentification</span>
                                                                <span>Gestion de profil</span>
                                                                <span>Gestion des utilisateurs</span>
                                                                <span>Gestion des formulaires</span>
                                                                <span>Gestion des produits</span>
                                                            @elseif($user->role == "Admin")
                                                                <span>Authentification</span>
                                                                <span>Gestion de profil</span>
                                                                <span>Gestion des formulaires</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($user->role =="Client")
                                    <div class="tab-pane fade show " id="per_details_ajout">
                                        @livewire("liste-produit-client",['id_user' => $user->id_user],key('liste-produit-client-123'))
                                    </div>
                                    <div class="tab-pane fade show active" id="per_details_possede">
                                        @livewire("liste-produit-client-owned",['id_user' => $user->id_user])
                                    </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include("Layouts.footer")
        </div>
        @include("Layouts.script_site")
    </body>
</html>

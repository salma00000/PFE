<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <title>{{auth()->user()->prenom}} {{auth()->user()->nom}} | Assistance Bot</title>
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
                                <h3 class="page-title">Profil</h3>
                                <ul class="breadcrumb">
                                   
                                    <li class="breadcrumb-item active">Profil</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session()->has("erreur"))
                                <div class = "alert alert-danger d-flex alert-dismissible fade show mt-1" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span class = "d-flex justify-content-start">
                                        {{session()->get('erreur')}}
                                    </span>
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                </div>
                            @elseif(Session()->has("success"))
                                <div class = "alert alert-success d-flex alert-dismissible fade show mt-1" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span class = "d-flex justify-content-start">
                                        {{session()->get('success')}}
                                    </span>
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                </div>
                            @endif
                            <div class="profile-header">
                                <div class="row align-items-center">
                                    <div class="col-auto profile-image">
                                        <a href="javascript:void(0)">
                                            <img class="rounded-circle" alt="Photo de profil" src="{{URL::asset(auth()->user()->image)}}">
                                        </a>
                                    </div>
                                    <div class="col ms-md-n2 profile-user-info">
                                        <h4 class="user-name mb-0">{{auth()->user()->prenom}} {{auth()->user()->nom}}</h4>
                                        <h6 class="text-muted">{{auth()->user()->role}}</h6>
                                        <div class="user-Location">
                                            <i class="fa fa-mobile"></i>
                                            {{substr(auth()->user()->mobile, 0, 2)." ".substr(auth()->user()->mobile, 2, 3)." ".substr(auth()->user()->mobile, 5, 3)}}
                                        </div>
                                        <div class="about-text text-capitalize"><?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->date_time_creation_user))))?></div>
                                    </div>
                                    <div class="col-auto profile-btn">
                                        <a href="{{url('/edit-photo-profil')}}" class="btn btn-primary">
                                            Modifier
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-menu">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">À propos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Modifier le mot de passe</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#infos_tab">Modifier les informations</a>
                                    </li>
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
                                                        <a class="edit-link" href="{{url('/edit-informations-profil')}}">
                                                            <i class="far fa-edit me-1"></i>
                                                            Modifier
                                                        </a>
                                                    </h5>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Nom :</p>
                                                        <p class="col-sm-9">{{auth()->user()->nom}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Prenom :</p>
                                                        <p class="col-sm-9">{{auth()->user()->prenom}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Adresse email :</p>
                                                        <p class="col-sm-9">{{auth()->user()->email}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Genre :</p>
                                                        <p class="col-sm-9">{{auth()->user()->genre}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Rôle :</p>
                                                        <p class="col-sm-9">{{auth()->user()->role}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Numéro Mobile :</p>
                                                        <p class="col-sm-9">+216 {{substr(auth()->user()->mobile, 0, 2)." ".substr(auth()->user()->mobile, 2, 3)." ".substr(auth()->user()->mobile, 5, 3)}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Horaire De Création :</p>
                                                        <p class="col-sm-9"><?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime(auth()->user()->date_time_creation_user))))?> à {{date("H:i", strtotime(auth()->user()->date_time_creation_user))}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span></span>
                                                       <!-- @if(auth()->user()->status_compte == true)
                                                            <a class="edit-link" href="javascript:void(0)" onclick = "modifierStatusCompte()">
                                                                <i class="far fa-edit me-1"></i>
                                                                
                                                            </a>
                                                        @else
                                                            <a class="edit-link" href="javascript:void(0)" onclick = "modifierStatusCompte()">
                                                                <i class="far fa-edit me-1"></i>
                                                                
                                                            </a>
                                                        @endif-->
                                                    </h5>
                                                    @if(auth()->user()->status_compte == true)
                                                        <!--<button class="btn btn-success" type="button">
                                                            <i class="fe fe-check-verified"></i> 
                                                            
                                                        </button>-->
                                                    @else
                                                        <!-- <button class="btn btn-danger" type="button">
                                                            <i class="fe fe-check-verified"></i> 
                                                            
                                                        </button>-->
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Autorisations </span>
                                                    </h5>
                                                    <div class="skill-tags">
                                                        @if(auth()->user()->role == "Super Admin")
                                                            <span>Authentification</span>
                                                            <span>Gestion de profil</span>
                                                            <span>Gestion des utilisateurs</span>
                                                            <span>Gestion des formulaires</span>
                                                            <span>Gestion des produits</span>
                                                            <span>Gestion ChatBot</span>

                                                        @elseif(auth()->user()->role == "Admin")
                                                            <span>Authentification</span>
                                                            <span>Gestion de profil</span>
                                                            <span>Gestion des formulaires</span>
                                                            <span>Gestion ChatBot</span>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="password_tab" class="tab-pane fade">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Mot De Passe</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-6">
                                                    <form name = "password-profil-form" id = "password-profil-form" method = "post" action = "{{url('/update-password-profil')}}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label>Ancien Mot De Passe</label>
                                                            <input type="password" class="form-control" name = "old_password" id = "old_password" placeholder = "Entrez votre ancien mot de passe.." required>
                                                            @if (session()->has('erreur_old_password'))
                                                                <p class="text-danger mt-2 mb-2">{{session()->get('erreur_old_password')}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nouveau Mot De Passe</label>
                                                            <input type="password" class="form-control" name = "new_password" id = "new_password" placeholder = "Entrez votre nouveau mot de passe.." required>
                                                            @if (session()->has('erreur_new_password'))
                                                                <p class="text-danger mt-2 mb-2">{{session()->get('erreur_new_password')}}</p>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Confirmez Le Nouveau Mot De Passe</label>
                                                            <input type="password" class="form-control" name = "confirm_new_password" id = "confirm_new_password" placeholder = "Confirmez votre nouveau mot de passe.." required>
                                                            @if (session()->has('erreur_new_password'))
                                                                <p class="text-danger mt-2 mb-2">{{session()->get('erreur_new_password')}}</p>
                                                            @endif
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Sauvegarder les modifications</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="infos_tab" class="tab-pane fade">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Informations</h5>
                                            <div class="row">
                                                <div class="col-md-10 col-lg-12">
                                                    <form name = "informations-profil-form" id = "informations-profil-form" method = "post" action = "{{url('/update-informations-profil')}}">
                                                        @csrf
                                                        <div class = "row">
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Nom</label>
                                                                    <input type="text" class="form-control" name = "nom" id = "nom" placeholder = "Entrez votre nom.." value = "{{auth()->user()->nom}}" required>
                                                                </div>
                                                            </div>
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Prénom</label>
                                                                    <input type="text" class="form-control" name = "prenom" id = "prenom" placeholder = "Entrez votre prénom.." value = "{{auth()->user()->prenom}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "row">
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Adresse Email</label>
                                                                    <input type="email" class="form-control" name = "email" id = "email" placeholder = "Entrez votre adresse email.." value = "{{auth()->user()->email}}" disabled required>
                                                                </div>
                                                            </div>
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Rôle</label>
                                                                    <input type="text" class="form-control" name = "role" id = "role" placeholder = "Entrez votre rôle.." value = "{{auth()->user()->role}}" disabled required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class = "row">
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Genre</label>
                                                                    <select class = "form-control" name = "genre" id = "genre" required>
                                                                        <option value = "#" selected disabled>Sélectionnez votre genre..</option>
                                                                        <option value = "Femme" <?php echo !auth()->user()->genre == null && auth()->user()->genre == 'Femme' ? 'selected' : '' ?>>Femme</option>
                                                                        <option value = "Homme" <?php echo !auth()->user()->genre == null && auth()->user()->genre == 'Homme' ? 'selected' : '' ?>>Homme</option>
                                                                        <option value = "Non spécifié" <?php echo !auth()->user()->genre == null && auth()->user()->genre == 'Non spécifié' ? 'selected' : ''; ?>>Non spécifié</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class = "col-md-6">
                                                                <div class="form-group">
                                                                    <label>Numéro Mobile</label>
                                                                    <input type="text" class="form-control" name = "mobile" id = "mobile" placeholder = "Entrez votre numéro mobile.." value = "{{auth()->user()->mobile}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Sauvegarder les modifications</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include("Layouts.footer")
        </div>
        @include("Layouts.script_site")
    </body>
</html>
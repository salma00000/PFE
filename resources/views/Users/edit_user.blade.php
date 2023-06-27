<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        @if(is_null($user))
            <title>Modifier l'utilisateur</title>
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
                                <h3 class="page-title">Modifier l'utilisateur</h3>
                                <ul class="breadcrumb">
                                  
                                    <li class="breadcrumb-item active">Modifier l'utilisateur</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card comman-shadow">
                                <div class="card-body">
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
                                        <form name = "update-user-form" id = "update-user-form" method = "post" action = "{{url('/update-user?id_user='.$_GET['id_user'])}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="form-title student-info">Modifier l'utilisateur</h5>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Nom <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "nom" id = "nom" placeholder="Entrez le nom.." value = "{{$user->nom}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Prénom <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "prenom" id = "prenom" placeholder="Entrez le prénom.." value = "{{$user->prenom}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Adresse email <span class="login-danger">*</span></label>
                                                        <input type="email" class="form-control" name = "email" id = "email" placeholder="Entrez l'adresse email.." value = "{{$user->email}}" disabled required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Mot de passe</label>
                                                        <input type="password" class="form-control" name = "password" id = "password" placeholder="Entrez le mot de passe..">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Genre <span class="login-danger">*</span></label>
                                                        <select class = "form-control" name = "genre" id = "genre" required>
                                                            <option value = "#" selected disabled>Sélectionnez le genre..</option>
                                                            <option value = "Femme" <?php echo !$user->genre == null && $user->genre == "Femme" ? "selected" : '' ?>>Femme</option>
                                                            <option value = "Homme" <?php  echo !$user->genre == null && $user->genre == "Homme" ? "selected" : '' ?>>Homme</option>
                                                            <option value = "Non spécifié" <?php echo !$user->genre == null && $user->genre == "Non spécifié" ? "selected" : '' ?>>Non spécifié</option>
                                                        </select>
                                                        @if (session()->has('erreur_genre'))
                                                            <p class="text-danger mt-2 mb-2">{{session()->get('erreur_genre')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Rôle <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "role" id = "role" placeholder="Entrez le rôle.." value = "{{$user->role}}" disabled required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group local-forms">
                                                        <label>Numéro mobile <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "mobile" id = "mobile" placeholder="Entrez le numéro mobile.." value = "{{$user->mobile}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                        @if (session()->has('erreur_mobile'))
                                                            <p class="text-danger mt-2 mb-2">{{session()->get('erreur_mobile')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="student-submit">
                                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
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
<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <title>Informations de profil | Assistance Bot</title>
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
                                <h3 class="page-title">Informations de profil</h3>
                                <ul class="breadcrumb">
                              
                                    <li class="breadcrumb-item active">Informations de profil</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Informations de profil</h5>
                                </div>
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
                                    <form name = "informations-profil-form" id = "informations-profil-form" method = "post" action = "{{url('/update-informations-profil')}}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class = "col-md-6">
                                                <div class="form-group">
                                                    <label>Nom</label>
                                                    <input type="text" class="form-control" id = "nom" name = "nom" placeholder = "Entrez votre nom.." value = "{{auth()->user()->nom}}" required>
                                                </div>
                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-group">
                                                    <label>Prénom</label>
                                                    <input type="text" class="form-control" id = "prenom" name = "prenom" placeholder = "Entrez votre prénom.." value = "{{auth()->user()->prenom}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
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
                                        <div class="row mb-3">
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
                                                @if (session()->has('erreur_genre'))
                                                    <p class="text-danger mt-2 mb-2">{{session()->get('erreur_genre')}}</p>
                                                @endif
                                            </div>
                                            <div class = "col-md-6">
                                                <div class="form-group">
                                                    <label>Numéro Mobile</label>
                                                    <input type="text" class="form-control" name = "mobile" id = "mobile" placeholder = "Entrez votre numéro mobile.." value = "{{auth()->user()->mobile}}" onKeyPress = "if(this.value.length==8) return false; return event.charCode>=48 && event.charCode<=57" required>
                                                </div>
                                                @if (session()->has('erreur_numero'))
                                                    <p class="text-danger mt-2 mb-2">{{session()->get('erreur_numero')}}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Modifier</button>
                                    </form>
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
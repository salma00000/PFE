<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <title>Modifier le produtit</title>
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
                                <h3 class="page-title">Modifier le produtit</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Modifier le produtit</li>
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
                                    @if(is_null($produit))
                                        <div class = "alert alert-warning d-flex alert-dismissible fade show mt-1" role = "alert">
                                            <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                                <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                            <span class = "d-flex justify-content-start">
                                                Malheureusement, nous n'avons pas trouvé un produit avec cette identifiant. Veuillez vérifier l'identifiant et réessayer plus tard.
                                            </span>
                                            <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                        </div>
                                    @else
                                        <form name = "update-produit-form" id = "update-produit-form" method = "post" action = "{{url('/update-produit?id_produit='.$_GET['id_produit'])}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="form-title student-info">Modifier le produit</h5>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Nom de produit<span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "nom_produit" id = "nom_produit" placeholder="Entrez le nom de produit.." value = "{{$produit->nom_produit}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group local-forms">
                                                        <label>Code de produit <span class="login-danger">*</span></label>
                                                        <input type="text" class="form-control" name = "code_produit" id = "code_produit" placeholder="Entrez le code de produit.." value = "{{$produit->code_produit}}" required>
                                                        @if (session()->has('erreur_code'))
                                                            <p class="text-danger mt-2 mb-2">{{session()->get('erreur_code')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group local-forms">
                                                        <label>Image de produit</label>
                                                        <input type="file" class="form-control" name = "file" id = "file" accept = "image/png, image/gif, image/jpeg">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group local-forms">
                                                        <label>Description de produit <span class="login-danger">*</span></label>
                                                        <textarea class="form-control" name = "description_produit" id = "description_produit" placeholder="Entrez la description de produit.." required>{{$produit->description_produit}}</textarea>
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
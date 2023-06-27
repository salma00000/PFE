<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <link rel = "stylesheet" href = "{{asset('/Site_files/css/pagination.css')}}">
        @livewireStyles
        <title>Formulaire | Assistance Bot</title>
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
                                <h3 class="page-title">Formulaire</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{url('/dashboard')}}"></a>
                                    </li>
                                    <li class="breadcrumb-item active">Formulaire</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(is_null($formulaire))
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="about-info">
                                            <h4>Formulaire</h4>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mb-0 text-center">
                                                <caption class = "text-center my-4">Informations de produit</caption>
                                                <thead>
                                                    <tr>
                                                        <th>Identifiant</th>
                                                        <th>Image</th>
                                                        <th>Nom</th>
                                                        <th>Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td>{{$formulaire->id_produit}}</td>
                                                        <td>
                                                            <img src = "{{URL::asset($formulaire->image_produit)}}" width = 100>
                                                        </td>
                                                        <td>{{$formulaire->nom_produit}}</td>
                                                        <td>{{$formulaire->code_produit}}</td>
                                                        <td>{{$formulaire->description_produit}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover table-bordered mb-0 text-center">
                                                <caption class = "text-center my-4">Informations de panne</caption>
                                                <thead>
                                                    <tr>
                                                        <th>Identifiant</th>
                                                        <th>Client</th>
                                                        <th>Admin</th>
                                                        <th>Date d'achat</th>
                                                        <th>Type</th>
                                                        <th>Description</th>
                                                        <th>Piéce</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr>
                                                        <td>{{$formulaire->id_formulaire}}</td>
                                                        <td>{{$formulaire->prenom}} {{$formulaire->nom}}</td>
                                                        <td>
                                                            @if($formulaire->id_admin == null)
                                                                <span class = "badge rounded-pill badge-soft-danger p-2">Non effectué</span>
                                                            @else
                                                                <span class = "badge rounded-pill badge-soft-success p-2">{{App\Http\Controllers\FormulaireController::getInformationsClient($formulaire->id_admin)->prenom}}                                                                 {{App\Http\Controllers\FormulaireController::getInformationsClient($formulaire->id_admin)->nom}}</span>
                                                            @endif
                                                        </td>
                                                        <td class = "text-capitalize">
                                                            <?php setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                                                            echo utf8_encode(strftime("%A %d %B %Y",strtotime($formulaire->date_achat)))?>
                                                        </td>
                                                        <td>{{$formulaire->type_probleme}}</td>
                                                        <td>{{$formulaire->description_probleme}}</td>
                                                        <td>{{$formulaire->piece_deffectueuse}}</td>
                                                        <td>
                                                            <img src = "{{URL::asset($formulaire->photo_probleme)}}" width = 100>
                                                        </td>
                                                        <td>
                                                            @if($formulaire->is_traited == true)
                                                                <span class = "badge rounded-pill badge-soft-success p-2">Traité</span>
                                                            @else
                                                                <span class = "badge rounded-pill badge-soft-danger p-2">Non traité</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @include("Layouts.footer")
        </div>
        @include("Layouts.script_site")
    </body>
</html>
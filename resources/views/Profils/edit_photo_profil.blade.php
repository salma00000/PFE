<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_site")
        <title>Photo de profil | Assistance Bot</title>
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
                                <h3 class="page-title">Photo de profil</h3>
                                <ul class="breadcrumb">
                                 
                                    <li class="breadcrumb-item active">Photo de profil</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Photo de profil</h5>
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
                                    <form name = "photo-profil-form" id = "photo-profil-form" method = "post" action = "{{url('/update-photo-profil')}}" enctype = 'multipart/form-data'>
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Photo de profil</label>
                                            <div class="col-md-10">
                                                <input type="file" class="form-control" id = "file" name = "file" accept = "image/png, image/gif, image/jpeg" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2"></label>
                                            <div class="col-md-6">
                                                <button class="btn btn-primary" type="submit">Modifier</button>
                                            </div>
                                        </div>
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
<div>
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="form-group">
                <input type="search" class="form-control" placeholder="Chercher des pannes.." name = "search_formulaires" id = "search_formulaires" wire:model = "search_formulaires" required>
            </div>
        </div>
    </div>
    <div class="row">
        @if(!empty($formulaires) && ($formulaires->count()))
            @foreach($formulaires as $data)
                <div class="col-md-6 col-xl-4 col-sm-12 d-flex">
                    <div class="blog grid-blog flex-fill">
                        <div class="blog-image">
                            <a href="{{url('/formulaire?id_formulaire='.$data->id_formulaire)}}">
                                <img class="img-fluid" src="{{URL::asset($data->photo_probleme)}}" alt="Photo de panne">
                            </a>
                        </div>
                        <div class="blog-content">
                            <ul class="entry-meta meta-item">
                                <li>
                                    <div class="post-author">
                                        <a href="javascript:void(0)">
                                            <img src="{{URL::asset($data->image)}}" alt="Photo de profil">
                                            <span>
                                                <span class="post-title">{{$data->prenom}} {{$data->nom}}</span>
                                                <span class="post-date">
                                                    <i class="far fa-clock"></i>
                                                    <?php setlocale (LC_TIME, 'fr_FR.utf8','fra');
                                                    echo utf8_encode(strftime("%A %d %B %Y",strtotime(strftime($data->date_achat))))?>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="javascript:void(0)">{{$data->nom_produit}}: Panne {{$data->type_probleme}}</a>
                            </h3>
                            <p>{{$data->description_probleme}}</p>
                        </div>
                        <div class="row">
                            <div class="edit-options">
                                <div class="edit-delete-btn">
                                    <a href="{{url('/formulaire?id_formulaire='.$data->id_formulaire)}}" class="text-success">
                                        <i class="feather-eye me-1"></i>
                                        Voir
                                    </a>
                                    @if($data->id_admin == null)
                                        <a href="javascript:void(0)" data-bs-toggle="modal" class="text-danger open" data-produit = "{{$data->nom_produit}}" data-id_formulaire = "{{$data->id_formulaire}}">
                                            <i class="feather-user-check me-1"></i>
                                            Affecter
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="text-danger" disabled>
                                            <i class="feather-user-check me-1"></i>
                                            Déjà affecté
                                        </a>
                                    @endif
                                </div>
                                <div class="text-end inactive-style">
                                    @if($data->is_traited == false)
                                        <a href="javascript:void(0);" class="text-danger">
                                            <i class="feather-eye-off me-1"></i>
                                            Non traité
                                        </a>
                                    @else
                                        <a href="javascript:void(0);" class="text-success">
                                            <i class="feather-eye me-1"></i>
                                            Traité
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class = "text-center mx-auto">Aucun formulaire actuellement trouvé.</p>
        @endif
    </div>
    <div class = "mt-4 mb-4">
        {{$formulaires->links("pagination::bootstrap-4")}}
    </div>

    <div id="affect-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center mt-0 mb-0">
                        <div class="auth-logo" style = "margin-top:-50px">
                            <a href="{{url('/dashboard')}}" class="logo logo-dark">
                                <span class="logo-lg">
                                    <img src="{{URL::asset('/Images/logo.png')}}" alt="Logo de l'application" height="300">
                                </span>
                            </a>
                        </div>
                    </div>
                    <form class="mx-3" method = "post" action="{{url('/affect-admin')}}" style = "margin-top:-50px">
                        @csrf
                        <div class="mb-3">
                            <label for="produit" class="form-label">Produit</label>
                            <input type="text" class="form-control" id="nom_produit" name="nom_produit" placeholder="Entrez le nom de produit" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="admin" class="form-label">Technicien</label>
                            <select class = "form-control" name = "admin" id = "admin" required>
                                <option value = "#" selected disabled>Sélectionnez le technicien..</option>
                                @if(empty($this->getListeAdmin()))
                                    <option value = "#">Aucun technicien actuellement trouvé.</option>
                                @else
                                    @foreach($this->getListeAdmin() as $data)
                                        <option value = "{{$data->id_user}}">{{$data->prenom}} {{$data->nom}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <input type = "hidden" name = "id_formulaire" id = "id_formulaire" required>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit">Affecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(function () {
            $(".open").click(function () {
                var produit = $(this).data('produit');
                var id_formulaire = $(this).data('id_formulaire');
                $("#nom_produit").val(produit);
                $("#id_formulaire").val(id_formulaire);
                $("#affect-modal").modal('show');
            })
        });
    </script>
</div>

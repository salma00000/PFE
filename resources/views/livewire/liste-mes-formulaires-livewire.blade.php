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
                                    @if($data->is_traited == false)
                                        <a href="{{url('/update-is-traited?id_formulaire='.$data->id_formulaire)}}" class="text-danger">
                                            <i class="feather-user--minus me-1"></i>
                                            Non traité
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="text-danger" disabled>
                                            <i class="feather-user-check me-1"></i>
                                            Traité
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
</div>

<div>
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-9 col-md-6">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Chercher des utilisateurs.." name = "search_users" id = "search_users" wire:model = "search_users" required>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="form-group local-forms">
                    <select class = "form-control" name = "role" id = "role" wire:model = "role_user" required>
                        <option value = "Tout" selected disabled>Sélectionnez le rôle..</option>
                        <option value = "Admin">Technicien</option>
                        <option value = "Client">Client</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card comman-shadow">
                <div class="card-body">
                    <div class="page-header">   
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Utilisateurs</h3>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{url('/liste-users-table')}}" class="btn btn-outline-gray me-2"><i class="feather-list"></i></a>
                                    <a href="{{url('/liste-users-grid')}}" class="btn btn-outline-gray me-2 active"><i class="feather-grid"></i></a>
                                    <a href="{{url('/create-user')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="student-pro-list">
                            <div class="row">
                                @if(!empty($users) && ($users->count()))
                                    @foreach($users as $data)
                                        <div class="col-xl-3 col-lg-4 col-md-6 d-flex">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="student-box flex-fill">
                                                        <div class="student-img">
                                                            <a href="{{url('user?id_user='.$data->id_user)}}">
                                                                <img class="img-fluid" alt="Photo de profil" src="{{URL::asset($data->image)}}">
                                                            </a>
                                                        </div>
                                                        <div class="student-content pb-0">
                                                            <h5><a href="{{url('user?id_user='.$data->id_user)}}">{{$data->prenom}} {{$data->nom}}</a></h5>
                                                            <h6>{{$data->role}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class = "text-center mx-auto">Aucun utilisateur actuellement trouvé.</p>
                                @endif
                            </div>
                        </div>
                        <div class = "mt-4 mb-4">
                            {{$users->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

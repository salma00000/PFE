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
                                    <a href="{{url('/liste-users-table')}}" class="btn btn-outline-gray me-2 active"><i class="feather-list"></i></a>
                                    <a href="{{url('/liste-users-grid')}}" class="btn btn-outline-gray me-2"><i class="feather-grid"></i></a>
                                    <a href="{{url('/create-user')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mt-5">
                            <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>#</th>
                                        <th>Utilisateur</th>
                                        <th>Adresse email</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($users) && ($users->count()))
                                        <?php $i = 1;?>
                                        @foreach($users as $data)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="{{url('user?id_user='.$data->id_user)}}" class="avatar avatar-sm me-2">
                                                            <img class="avatar-img rounded-circle" src="{{URL::asset($data->image)}}" alt="Photo de profil">
                                                        </a>
                                                        <a href="{{url('user?id_user='.$data->id_user)}}">{{$data->prenom}} {{$data->nom}}</a>
                                                    </h2>
                                                </td>
                                                <td>{{$data->email}}</td>
                                                <td>
                                                    @if($data->status_compte == true)
                                                        <span class = "rounded-pill badge-soft-success p-2">
                                                            Activé
                                                        </span>
                                                    @else
                                                        <span class = "rounded-pill badge-soft-danger p-2">
                                                            Désactivé
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions ">
                                                        <a href="{{url('/user?id_user='.$data->id_user)}}" class="btn btn-sm bg-success-light me-2">
                                                            <i class="feather-eye"></i>
                                                        </a>
                                                        <a href="{{url('/edit-user?id_user='.$data->id_user)}}" class="btn btn-sm bg-danger-light">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="btn btn-sm bg-danger-light" onclick = "questionSupprimerUser({{$data->id_user}})">
                                                            <i class="feather-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan = "6" class = "text-center">Aucun utilisateur actuellement trouvé.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
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

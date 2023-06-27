<div>
    <div class="student-group-form">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="form-group">
                    <input type="search" class="form-control" placeholder="Chercher des produits.." name = "search_produit" id = "search_produit" wire:model = "search_produit" required>
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
                                    <h3 class="page-title">Produits</h3>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{url('/create-produit')}}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-5">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>#</th>
                                            <th>Produit</th>
                                            <th>Code</th>
                                            <th>Description</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($produits) && ($produits->count()))
                                            <?php $i = 1;?>
                                            @foreach($produits as $data)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>
                                                        <a href="{{url('produit?id_produit='.$data->id_produit)}}">{{$data->nom_produit}}</a>
                                                    </td>
                                                    <td>{{$data->code_produit}}</td>
                                                    <td>{{$data->description_produit}}</td>
                                                    <td class="text-end">
                                                        <div class="actions ">
                                                            <a href="{{url('/produit?id_produit='.$data->id_produit)}}" class="btn btn-sm bg-success-light me-2">
                                                                <i class="feather-eye"></i>
                                                            </a>
                                                            @if(auth()->user()->role == "Super Admin")
                                                                <a href="{{url('/edit-produit?id_produit='.$data->id_produit)}}" class="btn btn-sm bg-danger-light">
                                                                    <i class="feather-edit"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" class="btn btn-sm bg-danger-light" onclick = "questionSupprimerProduit({{$data->id_produit}})">
                                                                    <i class="feather-trash"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan = "5" class = "text-center">Aucun produit actuellement trouvé.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class = "mt-4 mb-4">
                                {{$produits->links("pagination::bootstrap-4")}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

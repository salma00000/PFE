<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Models\Produit;
use App\Models\User;

class ListeProduitClient extends Component
{
    public $search_produit;
    public $currentPage = 1;
    public $id_user;

    use WithPagination;

    public function render(){

        $produits = Produit::where([
            ["nom_produit", "like", "%".$this->search_produit."%"],
        ])

        ->orWhere([
            ["code_produit", "like", "%".$this->search_produit."%"],
        ])

        ->orderBy("nom_produit", "asc")
        ->paginate(10, array("produits.*"));

        $client = User::where('id_user','=',$this->id_user)->get()->toArray();

        return view('livewire.liste-produit-client', [
            'produits' => $produits,
            'client' => $client
        ]);
    }

    public function setPage($url){
        $this->currentPage = explode("page=", $url)[1];

        Paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }
}

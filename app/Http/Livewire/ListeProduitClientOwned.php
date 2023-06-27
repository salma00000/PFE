<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Models\ClientProduct;
use App\Models\User;

class ListeProduitClientOwned extends Component
{
    public $search_produit;
    public $currentPage = 1;
    public $id_user;

    use WithPagination;

    public function render(){

        $client_produits = ClientProduct::withOnly('ProductDetails')->where('id_user','=',$this->id_user)
        ->get();


        $client = User::where('id_user','=',$this->id_user)->get()->toArray();

        return view('livewire.liste-produit-client-owned', [
            'client_produits' => $client_produits,
            'client' => $client
        ]);
    }

}

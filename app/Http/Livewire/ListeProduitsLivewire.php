<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Produit;

    class ListeProduitsLivewire extends Component{
        public $search_produit;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-produits-livewire', [
                'produits' => Produit::where([
                    ["nom_produit", "like", "%".$this->search_produit."%"],
                ])

                ->orWhere([
                    ["code_produit", "like", "%".$this->search_produit."%"],
                ])

                ->orderBy("nom_produit", "asc")
                ->paginate(10, array("produits.*"))
            ]);
        }

        public function setPage($url){
            $this->currentPage = explode("page=", $url)[1];

            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
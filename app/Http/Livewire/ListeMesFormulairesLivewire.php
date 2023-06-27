<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Formulaire;

    class ListeMesFormulairesLivewire extends Component{
        public $search_formulaires;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-mes-formulaires-livewire', [
                'formulaires' => Formulaire::where([
                    ["produits.nom_produit", "like", "%".$this->search_formulaires."%"],
                    ["users.role", "=", "Client"],
                    ["formulaires.id_admin", "=", auth()->user()->id_user]
                ])

                ->join("users", "users.id_user", "=", "formulaires.id_client")
                ->join("produits", "produits.nom_produit", "=", "formulaires.nom_produit")
                ->orderBy("users.prenom", "asc")
                ->paginate(10, array("formulaires.*", "users.*", "produits.*"))
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

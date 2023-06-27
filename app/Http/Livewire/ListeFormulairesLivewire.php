<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\Formulaire;
    use App\Models\User;

    class ListeFormulairesLivewire extends Component{
        public $search_formulaires;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            return view('livewire.liste-formulaires-livewire', [
                'formulaires' => Formulaire::where([
                    ["produits.nom_produit", "like", "%".$this->search_formulaires."%"],
                    ["users.role", "=", "Client"]
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

        public function getListeAdmin(){
            return User::where("role", "=", "Admin")->get();
        }
    }
?>

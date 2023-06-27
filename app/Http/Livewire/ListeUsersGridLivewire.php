<?php
    namespace App\Http\Livewire;
    use Livewire\Component;
    use Livewire\WithPagination;
    use Illuminate\Pagination\Paginator;
    use App\Models\User;

    class ListeUsersGridLivewire extends Component{
        public $role_user = "Tout";
        public $search_users;
        public $currentPage = 1;
        use WithPagination;

        public function render(){
            if($this->role_user == "Tout"){
                return view('livewire.liste-users-grid-livewire', [
                    'users' => User::where([
                        ["email", "<>", auth()->user()->email],
                        ["nom", "like", "%".$this->search_users."%"],
                    ])
    
                    ->orWhere([
                        ["email", "<>", auth()->user()->email],
                        ["prenom", "like", "%".$this->search_users."%"],
                    ])
    
                    ->orderBy("prenom", "asc")
                    ->paginate(10, array("users.*"))
                ]);
            }
            
            else{
                return view('livewire.liste-users-grid-livewire', [
                    "users" => User::where([
                        ["email", "<>", auth()->user()->email],
                        ["nom", "like", "%".$this->search_users."%"],
                        ["role", "like", "%".$this->role_user."%"],
                    ])

                    ->orWhere([
                        ["email", "<>", auth()->user()->email],
                        ["prenom", "like", "%".$this->search_users."%"],
                        ["role", "like", "%".$this->role_user."%"],
                    ])

                    ->orderBy("prenom", "asc")
                    ->paginate(10, array("users.*"))
                ]);
            }
        }

        public function setPage($url){
            $this->currentPage = explode("page=", $url)[1];

            Paginator::currentPageResolver(function(){
                return $this->currentPage;
            });
        }
    }
?>
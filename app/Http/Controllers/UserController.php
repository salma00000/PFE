<?php

    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\EnvoyerParametresAccesUser;
    use Hash;
    use App\Models\User;
    use App\Models\Produit;
    use App\Models\ClientProduct;

    class UserController extends Controller{

        public function ouvrirCreateUser(){
            return view("Users.create_user");
        }

        public function gestionAddUser(Request $request){

            if($this->checkUserExist($request->email)){
                return back()->with("erreur_email", "Nous sommes désolés de vous informer que cette adresse email est utilisé pour créer un autre compte.");
            }

            elseif(is_null($request->genre)){
                return back()->with("erreur_genre", "Vous devez sélectionner le genre.");
            }

            elseif(is_null($request->role)){
                return back()->with("erreur_role", "Vous devez sélectionner le rôle.");
            }

            elseif(!$this->verifierStringLength($request->mobile)){
                return back()->with("erreur_mobile", "Le numéro mobile doit être composé de 8 chiffres.");
            }

            elseif($this->verifierSiNumeroMobileExist($request->mobile)){
                return back()->with("erreur_mobile", "Nous sommes désolés de vous informer que ce numéro mobile est utilisé pour créer un autre compte.");
            }

            elseif($this->creerNewUser($request->nom, $request->prenom, $request->email, $request->password, $request->genre, $request->role, $request->mobile)){
                $this->envoyerNewUserCreer($request->nom, $request->prenom, $request->email, $request->password);
                return back()->with("success", "Nous sommes très heureux de vous informer que ce nouveau utilisateur a été créé avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas créer ce nouveau utilisateur pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function checkUserExist($email){
            return User::where("email", "=", $email)->exists();
        }

        public function verifierStringLength($string){
            return Str::length($string) == 8;
        }

        public function verifierSiNumeroMobileExist($numero){
            return User::where("mobile", "=", $numero)->exists();
        }

        public function creerNewUser($nom, $prenom, $email, $password, $genre, $role, $numero){

            $user = new User();
            $user->nom = $nom;
            $user->prenom = $prenom;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->genre = $genre;
            $user->role = $role;
            $user->mobile = $numero;

            return $user->save();
        }


        public function creeUserProduits(Request $request)
        {
            foreach($request['produits'] as $produit)
            {
                $data = [
                    'id_user' => $request['id_user'],
                    'id_produit'=>$produit
                ];

                $create = ClientProduct::create($data);
            }

            return redirect()->back();
        }

        public function DeleteUserProduits(Request $request)
        {
            foreach($request['produits'] as $produit)
            {
                $data = [
                    'id_user' => $request['id_user'],
                    'id_produit'=>$produit
                ];

                $clientProduct = ClientProduct::where(['id_user' => $request['id_user'],'id_produit' => $produit])->get();

                $clientProduct = ClientProduct::find($clientProduct[0]['id']);

                $clientProduct->delete();

            }

            return redirect()->back();
        }

        public function envoyerNewUserCreer($nom, $prenom, $email, $password){
            $mailData = [
                'email' => $email,
                'fullname' => $prenom." ".$nom,
                'password' => $password
            ];

            return Mail::to($email)->send(new EnvoyerParametresAccesUser($mailData));
        }

        public function ouvrirListeUsersTable(){
            return view("Users.liste_users_table");
        }

        public function ouvrirUser(Request $request){

            $user = $this->getInformationsUserWithId($request->input("id_user"));

            $owned_products = ClientProduct::with('ProductDetails')->where('id_user','=',$request->input('id_user'))->get();

            $products_list = Produit::all();

            return view("Users.user", compact("user",'owned_products','products_list'));
        }

        public function getInformationsUserWithId($id_user){
            return User::where("id_user", "=", $id_user)->first();
        }

        public function gestionDeleteUser(Request $request){
            if($this->deleteUser($request->input("id_user"))){
                return back()->with("success", "Nous sommes très heureux de vous informer que cette utilisateur a été supprimé avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas supprimer cette utilisateur pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function deleteUser($id_user){
            return User::where("id_user", "=", $id_user)->delete();
        }

        public function ouvrirEditUser(Request $request){
            $user = $this->getInformationsUserWithId($request->input("id_user"));
            return view("Users.edit_user", compact("user"));
        }

        public function gestionUpdateUser(Request $request){
            if(is_null($request->genre)){
                return back()->with("erreur_genre", "Vous devez sélectionner le genre.");
            }

            elseif(!$this->verifierStringLength($request->mobile)){
                return back()->with("erreur_mobile", "Votre numéro mobile doit être composé de 8 chiffres.");
            }

            elseif($this->verifierSiNumeroMobileExistNotActuel($request->mobile, $request->input("id_user"))){
                return back()->with("erreur_mobile", "Nous sommes désolés de vous informer que ce numéro mobile est utilisé pour créer un autre compte.");
            }

            elseif($this->updateUser($request->nom, $request->prenom, $request->genre, $request->password, $request->mobile, $request->input("id_user"))){
                return back()->with("success", "Nous sommes très heureux de vous informer que cette utilisateur a été modifié avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier cette utilisateur pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function verifierSiNumeroMobileExistNotActuel($numero, $id_user){
            return User::where("mobile", "=", $numero)->where("id_user", "<>", $id_user)->exists();
        }

        public function updateUser($nom, $prenom, $genre, $password, $mobile, $id_user){
            if(is_null($password)){
                return User::where("id_user", "=", $id_user)->update([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "mobile" => $mobile,
                    "genre" => $genre
                ]);
            }

            else{
                return User::where("id_user", "=", $id_user)->update([
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "mobile" => $mobile,
                    "genre" => $genre,
                    "password" => Hash::make($password)
                ]);
            }
        }

        public function ouvrirListeUsersGrid(){
            return view("Users.liste_users_grid");
        }
    }
?>

<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Hash;
    use App\Models\User;

    class ProfilController extends Controller{
        public function ouvrirProfil(){
            return view("Profils.profil");
        }

        public function ouvrirEditPhotoProfil(){
            return view("Profils.edit_photo_profil");
        }

        public function gestionUpdatePhotoDeProfil(Request $request){
            if($this->updatePhotoProfil($request, auth()->user()->id_user)){
                return back()->with("success", "Nous sommes très heureux de vous informer que votre photo de profil a été modifiée avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier votre photo de profil pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function updatePhotoProfil($request, $id_user){
            $filename = time().$request->file('file')->getClientOriginalName();
            $path = $request->file->move('Profils_pictures/'.$id_user, $filename);

            return User::where('id_user', '=', $id_user)->update([
                'image' => $path
            ]);
        }

        public function gestionUpdateStatusDeProfil(Request $request){
            if(auth()->user()->status_compte == true){
                if($this->updateStatusProfil(false, auth()->user()->id_user)){
                    return redirect("/profil")->with("success", "Nous sommes très heureux de vous informer que votre photo de profil a été modifiée avec succès.");
                }

                else{
                    return redirect("/profil")->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier votre photo de profil pour le moment. Veuillez réessayer plus tard.");
                }
            }

            else{
                if($this->updateStatusProfil(true, auth()->user()->id_user)){
                    return redirect("/profil")->with("success", "Nous sommes très heureux de vous informer que votre photo de profil a été modifiée avec succès.");
                }

                else{
                    return redirect("/profil")->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier votre photo de profil pour le moment. Veuillez réessayer plus tard.");
                }
            }
        }

        public function updateStatusProfil($status, $id_user){
            return User::where('id_user', '=', $id_user)->update([
                'status_compte' => $status
            ]);
        }

        public function ouvrirEditInformationsProfil(){
            return view("Profils.edit_informations_profil");
        }

        public function gestionUpdateInformationsDeProfil(Request $request){
            if(is_null($request->genre)){
                return back()->with("erreur_genre", "Vous devez sélectionner votre genre.");
            }

            elseif(!$this->verifierStringLength($request->mobile)){
                return back()->with("erreur_numero", "Votre numéro mobile doit être composé de 8 chiffres.");
            }

            elseif($this->verifierSiNumeroMobileExist($request->mobile, auth()->user()->id_user)){
                return back()->with("erreur_numero", "Nous sommes désolés de vous informer que ce numéro mobile est utilisé pour créer un autre compte.");
            }

            elseif($this->updateInformationsProfil($request->nom, $request->prenom, $request->genre, $request->mobile, auth()->user()->id_user)){
                return back()->with("success", "Nous sommes très heureux de vous informer que vos informations ont été modifiés avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier vos informations pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function verifierStringLength($string){
            return Str::length($string) == 8;
        }

        public function verifierSiNumeroMobileExist($numero, $id_user){
            return User::where("mobile", "=", $numero)->where("id_user", "<>", $id_user)->exists();
        }

        public function updateInformationsProfil($nom, $prenom, $genre, $mobile, $id_user){
            return User::where("id_user", "=", $id_user)->update([
                "nom" => $nom,
                "prenom" => $prenom,
                "mobile" => $mobile,
                "genre" => $genre
            ]);
        }

        public function gestionUpdatePasswordDeProfil(Request $request){
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("erreur_old_password", "Votre ancien mot de passe saisi n'est pas correct.");
            }

            elseif($request->new_password != $request->confirm_new_password){
                return back()->with("erreur_new_password", "Les deux mots de passe ne sont pas identiques.");
            }

            elseif(Hash::check($request->new_password, auth()->user()->password)){
                return back()->with("erreur_new_password", "Le mot de passe saisie est votre ancien mot de passe.");
            }

            elseif($this->updatePasswordProfil($request->new_password, auth()->user()->id_user)){
                return back()->with("success", "Nous sommes très heureux de vous informer que votre mot de passe a été modifié avec succès.");
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas modifier votre mot de passe pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function updatePasswordProfil($password, $id_user){
            return User::where("id_user", "=", $id_user)->update([
                "password" => Hash::make($password)
            ]);
        }
    }
?>

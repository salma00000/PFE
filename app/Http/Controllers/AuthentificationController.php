<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Str;
    use App\Mail\EnvoyerMailLinkResetPassword;
    use Session;
    use Hash;
    use App\Models\User;
    use App\Models\PasswordResetToken;

    class AuthentificationController extends Controller{
        public function ouvrirSignin(){

            return view("Authentification.login");
        }

        public function LoginAPi (Request $request)
        {
            if(!auth()->attempt([
                "email" => $request['email'],
                "password" => $request['password']
            ]))  return response()->json(['status'=>'error','message'=>'unauthorized'],403);

            else return response()->json(['status'=>'success'],200);
        }

        public function gestionLogin(Request $request){
            if(!$this->checkUserExist($request->email)){
                return back()->with("erreur_email", "Nous sommes désolés ! Nous n'avons pas trouvé votre compte.");
            }

            elseif($this->getInformationsUserWithEmail($request->email)->role != "Admin" && $this->getInformationsUserWithEmail($request->email)->role != "Super Admin"){
                return back()->with("erreur", "Nous sommes désolés de vous informer que vous n'êtes pas autorisé à utiliser cette application.");
            }

            elseif(!$this->checkEmailPasswordValide($request->email, $request->password)){
                return back()->with("erreur_password", "Une erreur s'est produite lors de la tentative de connexion. Vérifiez votre mot de passe et réessayez plus tard.");
            }

            else{
                $this->creerSessionUser($request->email);
                return redirect("/profil");
            }
        }

        public function checkUserExist($email){
            return User::where("email", "=", $email)->exists();
        }

        public function getInformationsUserWithEmail($email){
            return User::where("email", "=", $email)->first();
        }

        public function checkEmailPasswordValide($email, $password){
            $credentials = request(['email', 'password']);
            return Auth::attempt($credentials);
        }

        public function creerSessionUser($email){
            Session::put('email', $email);;
        }

        public function ouvrirForgetPassword(){
            return view("Authentification.forget_password");
        }

        public function gestionForgetPassword(Request $request){
            $token = $this->generateToken();

            if(!$this->checkUserExist($request->email)){
                return back()->with("erreur_email", "Nous sommes désolés ! Nous n'avons pas trouvé votre compte.");
            }

            elseif($this->getInformationsUserWithEmail($request->email)->role != "Admin" && $this->getInformationsUserWithEmail($request->email)->role != "Super Admin"){
                return back()->with("erreur", "Nous sommes désolés de vous informer que vous n'êtes pas autorisé à utiliser cette application.");
            }

            elseif($this->sendMailLinkResetPassword($this->getInformationsUserWithEmail($request->email)->nom, $this->getInformationsUserWithEmail($request->email)->prenom, $request->email, $token, $this->getInformationsUserWithEmail($request->email)->id_user)){
                if($this->verifierIfLinkResetPasswordExist($this->getInformationsUserWithEmail($request->email)->id_user)){
                    $this->updateLinkResetPassword($this->getInformationsUserWithEmail($request->email)->id_user, $token);
                    return back()->with("email_sent", "Un email a été envoyé à l'adresse ".$request->email.". Veuillez rechercher dans votre boite de réception l'e-mail reçue et cliquez sur le lien inclus pour réinitialiser votre mot de passe.");
                }

                else{
                    $this->creerLinkResetPassword($this->getInformationsUserWithEmail($request->email)->id_user, $token);
                    return back()->with("email_sent", "Un email a été envoyé à l'adresse ".$request->email.". Veuillez rechercher dans votre boite de réception l'e-mail reçue et cliquez sur le lien inclus pour réinitialiser votre mot de passe.");
                }
            }

            else{
                return back()->with("erreur", "Pour des raisons techniques, vous ne pouvez pas recevoir l'email pour le moment. Veuillez réessayer plus tard.");
            }
        }

        public function generateToken(){
            return Str::random(64);
        }

        public function sendMailLinkResetPassword($nom, $prenom, $email, $token, $id_user){
            $mailData = [
                'email' => $email,
                'fullname' => $prenom." ".$nom,
                'token' => $token,
                'id_user' => $id_user
            ];

            return Mail::to($email)->send(new EnvoyerMailLinkResetPassword($mailData));
        }

        public function creerLinkResetPassword($id_user, $token){
            $link = new PasswordResetToken();
            $link->token = $token;
            $link->id_user = $id_user;

            return $link->save();
        }

        public function updateLinkResetPassword($id_user, $token){
            return PasswordResetToken::where("id_user", "=", $id_user)->update([
                "token" => $token,
                "date_time_creation_link" => now()
            ]);
        }

        public function verifierIfLinkResetPasswordExist($id_user){
            return PasswordResetToken::where("id_user", "=", $id_user)->exists();
        }

        public function ouvrirUpdatePassword(Request $request){
            $token = $request->token;
            $id_user = $request->input('id_user');
            $check_token = $this->verifierIfTokenResetPasswordExist($id_user, $token);
            return view("Authentification.update_password", compact("token", "id_user", "check_token"));
        }

        public function verifierIfTokenResetPasswordExist($id_user, $token){
            return PasswordResetToken::where("id_user", "=", $id_user)->where("token", "=", $token)->exists();
        }

        public function gestionUpdatePasswordForget(Request $request){
            if($request->password != $request->confirm_password){
                return back()->with("erreur_password", "Les deux mots de passe ne sont pas identiques.");
            }

            else if($this->updatePasswordUser($request->password, $request->input("id_user"))){
                return redirect("/");
            }
        }

        public function updatePasswordUser($password, $id_user){
            return User::where("id_user", "=", $id_user)->update([
                "password" => Hash::make($password)
            ]);
        }

        public function getInformationsUserWithId($id){
            return User::where("id_user", "=", $id)->first();
        }

        public function gestionLogout(){
            if($this->logoutUser()){
                return redirect("/");
            }

            else{
                return back();
            }
        }

        public function logoutUser(){
            Session::forget('email');
            Session::flush();
            auth()->logout();

            if (!Session::has('email')){
                return true;
            }

            else{
                return false;
            }
        }
    }
?>

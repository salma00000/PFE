<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_auth")
        <title>Connexion | Assistance Bot</title>
    </head>
    <body>
        <div class="main">
            <div class="">
                <div class="signup-content">
                    <div class="signup-img">
                        <img src="{{asset('/Auth_files/images/signup-img.jpg')}}" alt="Login picture">
                    </div>
                    <div class="signup-form">
                        <form method="post" class="register-form" id="login-form" name = "login-form" action = "{{url('/post-login')}}">
                            @csrf
                            <h2>Connexion des employés</h2>
                            @if(Session()->has("erreur"))
                                <div class = "alert alert-danger d-flex alert-dismissible fade show mt-1" role = "alert">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" fill = "currentColor" class = "bi flex-shrink-0 me-2" viewBox = "0 0 16 16" role = "img" aria-label = "Warning:">
                                        <path d = "M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    <span class = "d-flex justify-content-start">
                                        {{session()->get('erreur')}}
                                    </span>
                                    <button type = "button" class = "btn-close" data-bs-dismiss = "alert" aria-label = "Close"></button>
                                </div>
                            @endif
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Adresse email :</label>
                                    <input type="email" name="email" id="email" placeholder = "Entrez votre adresse email.." required/>
                                    @if (session()->has('erreur_email'))
                                        <p class="text-danger mt-2 mb-2">{{session()->get('erreur_email')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Mot de passe :</label>
                                    <input type="password" name="password" id="password" placeholder = "Entrez votre mot de passe.." required/>
                                    @if (session()->has('erreur_password'))
                                        <p class="text-danger mt-2 mb-2">{{session()->get('erreur_password')}}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-submit">
                            <a href = "{{url('/forget-password')}}" class = "link float-end">Mot De Passe Oublié ?</a>
                                <input type="submit" value="Se connecter" class="submit" name="submit" id="submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include("Layouts.script_auth")
    </body>
</html>
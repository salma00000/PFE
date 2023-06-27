<!DOCTYPE html>
<html lang="en">
    <head>
        @include("Layouts.head_auth")
        <title>Mot de passe oublié | Assistance Bot</title>
    </head>
    <body>
        <div class="main">
            <div class="">
                <div class="signup-content">
                    <div class="signup-img">
                        <img src="{{asset('/Auth_files/images/signup-img.jpg')}}" alt="Login picture">
                    </div>
                    <div class="signup-form">
                        <form method="post" class="register-form" id="forget-password-form" name = "forget-password-form" action = "{{url('/post-forget-password')}}">
                            @if(!Session()->has("email_sent"))
                                @csrf
                                <h2>Mot de passe oublié</h2>
                                <p class = "mb-4 text-muted">Entrez votre adresse email et nous vous enverrons un e-mail avec des instructions pour réinitialiser votre mot de passe.</p>
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
                                <div class="form-submit">
                                    <a href = "{{url('/')}}" class = "link_back">Retour à la page de connexion</a>
                                    <input type="submit" value="Réinitialiser" class="submit float-end" name="submit" id="submit" />
                                </div>
                            @else
                                <div class = "mr-3 me-auto" style = "margin-top:170px">
                                    <h4 class = "text-center">Merci de consulter vos emails</h4>
                                    <p class = "mt-3 text-muted">{{session()->get("email_sent")}}</p>
                                    <a href = "{{url('/')}}" class = "btn btn-back-home mt-2 mb-2 text-center">Retour à la page de connexion</a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include("Layouts.script_auth")
    </body>
</html>
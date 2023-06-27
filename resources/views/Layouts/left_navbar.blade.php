<div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="menu-title">
                <span>Menu Principal</span>
            </li>
   
            <li>
                <a href="{{url('/profil')}}">
                    <i class="feather-user"></i>
                    <span> Profil</span>
                </a>
            </li>
            @if(auth()->user()->role == "Super Admin")
                <li class="submenu">
                    <a href="javascript:void(0)">
                        <i class="feather-users"></i>
                        <span> Utilisateurs</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/liste-users-table')}}">Gestion des utilisateurs</a>
                        </li>
                        <li>
                            <a href="{{url('/create-user')}}">Créer un utilisateur</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->role == "Super Admin" || auth()->user()->role == "Admin")
            <li class="submenu">
                <a href="javascript:void(0)">
                    <i class="feather-message-circle"></i>
                    <span> ChatBot</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li>
                        <a href="{{url('/liste-chatbot')}}">Gestion ChatBot</a>
                    </li>
                    <li>
                        <a href="{{url('/ouvrir_cree_chatbot')}}">Créer QA</a>
                    </li>
                </ul>
            </li>
        @endif
            <li class="submenu">
                <a href="javascript:void(0)">
                    <i class="feather-shopping-cart"></i>
                    <span> Produits</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li>
                        <a href="{{url('/liste-produits')}}">Gestion des produits</a>
                    </li>
                    @if(auth()->user()->role == "Super Admin")
                        <li>
                            <a href="{{url('/create-produit')}}">Créer un produit</a>
                        </li>
                    @endif
                </ul>
            </li>
            @if(auth()->user()->role == "Super Admin")
                <li class="submenu">
                    <a href="javascript:void(0)">
                        <i class="feather-package"></i>
                        <span> Formulaires</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/liste-formulaires')}}">Gestion des formulaires</a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="submenu">
                    <a href="javascript:void(0)">
                        <i class="feather-package"></i>
                        <span> Mes Formulaires</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('/liste-mes-formulaires')}}">Gestion des formulaires</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>

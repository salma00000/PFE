<div class="header-left">
    <a href="{{url('/dashboard')}}" class="logo">
        <img src="{{URL::asset('/Images/logo.png')}}" alt="Logo">
    </a>
    <a href="{{url('/dashboard')}}" class="logo logo-small">
        <img src="{{URL::asset('/Images/favicon.png')}}" alt="Logo">
    </a>
</div>
<div class="menu-toggle">
    <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-bars"></i>
    </a>
</div>
<div class="top-nav-search">
    <form>
        <input type="text" class="form-control" placeholder="Rechercher.." required>
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    </form>
</div>
<a class="mobile_btn" id="mobile_btn">
    <i class="fas fa-bars"></i>
</a>
<ul class="nav user-menu">
    <li class="nav-item zoom-screen me-2">
        <a href="#" class="nav-link header-nav-list">
            <img src="{{URL::asset('Site_files/img/icons/header-icon-04.svg')}}" alt="">
        </a>
    </li>
    <li class="nav-item dropdown has-arrow new-user-menus">
        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
            <span class="user-img">
                <img class="rounded-circle" src="{{URL::asset(auth()->user()->image)}}" width="31" alt="Photo de profil">
                <div class="user-text">
                    <h6>{{auth()->user()->prenom}} {{auth()->user()->nom}}</h6>
                    <p class="text-muted mb-0">{{auth()->user()->role}}</p>
                </div>
            </span>
        </a>
        <div class="dropdown-menu">
            <div class="user-header">
                <div class="avatar avatar-sm">
                    <img src="{{URL::asset(auth()->user()->image)}}" alt="Photo de profil" class="avatar-img rounded-circle">
                </div>
                <div class="user-text">
                    <h6>{{auth()->user()->prenom}} {{auth()->user()->nom}}</h6>
                    <p class="text-muted mb-0">{{auth()->user()->role}}</p>
                </div>
            </div>
            <a class="dropdown-item" href="{{url('/profil')}}">Profil</a>
            <a class="dropdown-item" href="javascript:void(0)" onclick = "questionDeconnexion()">Déconnexion</a>
        </div>
    </li>
</ul>
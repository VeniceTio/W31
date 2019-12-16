<header role="banner">
    <a href="/"><img src="/images/LogoMaths.png" width="50px" height="50px" alt="Logo de l'équipe"/></a>
    <h1>Laragames</h1>
    @isset($user)
        <div class="dropdown" role="navigation">
            <a class="dropbtn" href="/admin/welcome"><img src="/images/ImageCompte.png" width="50px" height="50px" aria-label="Mon compte" alt="Logo de l'équipe"/></a>
            <!--<button class="dropbtn">Dropdown</button>-->
            <div class="dropdown-content">
                <a href="/admin/welcome">Compte</a>
                <a href="/admin/game/newGame">Ajouter un jeu</a>
                <a href="/admin/signout">Déconnexion</a>
            </div>
        </div>
    @endisset
    @empty($user)
        <a href="/signin" class="sign" id="signin">Se connecter</a>
        <a href="/signup" class="sign" id="signup">S'inscrire</a>
    @endempty
</header>

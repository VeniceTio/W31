<header>
    <a href="/"><img src="images/LogoMaths.png" width="50px" height="50px"/></a>
    <h1>Projet MATHS</h1>
    @isset($logged)
        <a href="profil"><img src="images/ImageCompte.png" width="50px" height="50px"/>Profil</a>
    @endisset
    @empty($logged)
        <a href="signin" class="sign" id="signin">Sign in</a>
        <a href="signup" class="sign" id="signup">Sign up</a>
    @endempty
</header>

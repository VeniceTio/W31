<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout.app')
@section('titre', 'New Subject')
@section('content')
    @parent
    <form action="createGame" method="post" id="addUserForm" title="Créez un nouveau jeu" aria-label="Créer un nouveau jeu" role="form">
        @csrf
        <fieldset>
            <label class="fs_title" for="titre">Créez un nouveau Jeu</label>
            <input type="text" name="name" id="name" placeholder="Nom du jeu" role="textbox" autofocus required>
            <label style="text-align: center" for="url" aria-label="Entrez l'URL de l'image">Entrez l'URL de l'image</label>
            <input type="text" name="url" id="url" placeholder="URL de l'image" role="textbox" autofocus required>
            <label style="text-align: center" for="add-user-form" aria-label="Entrez une description du jeu">Entrez une description du jeu</label>
            <textarea rows="4" cols="50" name="desc" id="add-user-form" form="addUserForm" placeholder="Description du jeu..." role="textbox"></textarea>
            <input type="submit" value="Enregistrer" form="addUserForm">
        </fieldset>
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/passwordFormat.js') }}"></script>
@endsection

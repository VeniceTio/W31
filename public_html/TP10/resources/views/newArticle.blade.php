<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout.app')
@section('titre', 'New Subject')
@section('content')
    @parent
    <form action="createArticle" method="post" id="addUserForm" title="Créez un nouvelle article" aria-label="Créer un nouvelle article" role="form">
        @csrf
        <fieldset>
            <label class="fs_title" for="titre">Créez un nouveau sujet</label>
            <input type="text" name="titre" id="titre" placeholder="Titre de l'article" role="textbox" autofocus required>
            <label style="text-align: center" for="category" aria-label="Choisir une catégorie">Choisir une catégorie</label>
            <select style="margin-top: 1vh; margin-bottom: 1vh; margin-left: 100px" name="category" id ="category" required>
                @forelse ($categories as $category)
                    <option style="list-style-type: none" form="addUserForm" value="{{$category->name}}">
                        {{$category->name}}
                    </option>
                @empty
                    <li>No categories</li>
                @endforelse
            </select>
            <label style="text-align: center" for="add-user-form" aria-label="Entrez votre phrase d'accroche">Entrez votre phrase d'accroche</label>
            <textarea rows="4" cols="50" name="accroche" id="add-user-form" form="addUserForm" placeholder="Phrase d'accroche..." role="textbox"></textarea>
            <label style="text-align: center" for="add-user-form" aria-label="Entrez le contenu de votre article">Entrez le contenu de votre article</label>
            <textarea rows="4" cols="50" name="content" id="add-user-form" form="addUserForm" placeholder="Votre Article..." role="textbox"></textarea>
            <input type="submit" value="Enregistrer" form="addUserForm">
        </fieldset>
    </form>
    <script type="text/javascript" src="{{ URL::asset('js/passwordFormat.js') }}"></script>
@endsection

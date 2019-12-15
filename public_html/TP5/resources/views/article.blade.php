@extends('layout/app')
@section('titre','Article')
@section('content')
    @parent
    <p> <a href="/">Home</a> / <a href="/news/categories">Categories</a> / <a href="/news/category/{{$catId}}">{{$catId}}</a></p>
    <article class="article">
        <h2>{{ $article->Titre}}</h2>
        <h3>{{ $article->Phrase_accroche}}</h3>
        <p>{{$article->Contenu_textuel}}</p>
        <p>{{$article->Auteur}}</p>
    </article>


@endsection

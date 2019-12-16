<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@extends('layout/app')
@section('titre','Subjects')


@section('content')
    @parent
    <section class="panel">
        <p><a href="/" class="arbre" >Accueil</a> / <a href="/news/categories">Categories</a> / </p>
        <a href="/admin/write/newArticle" class="button" >Ajouter un sujet</a>
        <section>
            <ul class="liste">
                @forelse($articles as $article)
                    <li style="list-style-type: none"><a href="{{$catId}}/{{ $article->id}}" class="subject" >{{ $article->Titre}}</a></li>
                @empty
                    <li class="nocontent">Pas d'article'. Soyez le premier à en publier un !</li>
                @endforelse
            </ul>
        </section>
    </section>
@endsection

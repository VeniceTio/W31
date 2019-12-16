@extends('layout/app')
@section('titre','Home')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">

@section('content')
    @parent
    <section class="panel résumé">
    @foreach($articles as $article)
            <article class="article">
                <h2><a href="/article/{{$article->id}}">{{ $article->Titre}}</a></h2>
                <p>{{ $article->Phrase_accroche}}</p>
            </article>
    @endforeach
    </section>
    <section class="nav">
        <a href="/news/categories" role="button" aria-label="Rubrique">Rubrique</a>
        <a href="/admin/write/newArticle" role="button" aria-label="Écrire un article">Écrire un article</a>
    </section>
    <section class="panel résumé">
        @foreach($Allarticles as $article)
            <article class="article">
                <h2><a href="/article/{{$article->id}}">{{ $article->Titre}}</a></h2>
            </article>
        @endforeach
    </section>
@endsection

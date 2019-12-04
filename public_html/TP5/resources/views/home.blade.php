@extends('layout/app')
@section('titre','Home')


@section('content')
    @parent
    <section class="panel résumé">
    @foreach($articles as $article)
            <article class="article">
                <h2>{{ $article->Titre}}</h2>
                <p>{{ $article->Phrase_accroche}}</p>
            </article>
    @endforeach
    </section>
    <section class="panel résumé">
        @foreach($Allarticles as $article)
            <article class="article">
                <h2>{{ $article->Titre}}</h2>
            </article>
        @endforeach
    </section>
@endsection

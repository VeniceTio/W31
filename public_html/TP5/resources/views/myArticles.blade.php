@extends('layout/app')
@section('titre','My Articles')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">

@section('content')
    @parent
    <a href="/admin/write/newArticle" class="button" >Ajouter un sujet</a>
    <section>
        <ul class="liste">
            @forelse($articles as $article)
                <li style="list-style-type: none">
                    <a href="#" class="subject" >
                        {{ $article->Titre}}
                    </a>
                    <div class="option">
                        @if($article->Publié == '0')
                            <a href="/admin/write/publish/{{$article->id}}/1" style="background-color: red">Unpublish</a>
                        @else
                            <a href="/admin/write/publish/{{$article->id}}/0" style="background-color: green">Publish</a>
                        @endif
                        <a href="/admin/write/modify/{{$article->id}}">Modify Content</a>
                        <a href="/admin/write/delete/{{$article->id}}">Delete</a>
                    </div>
                </li>

            @empty
                <li class="nocontent">Pas de sujets. Publiez votre premier article !</li>
            @endforelse
        </ul>
    </section>
@endsection

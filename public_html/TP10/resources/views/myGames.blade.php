@extends('layout/app')
@section('titre','My Articles')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">

@section('content')
    @parent
    <a href="/admin/write/newArticle" class="button" >Ajouter un sujet</a>
    <section>
        <ul class="liste">
            @forelse($games as $game)
                <li style="list-style-type: none">
                    <img href="{{ URL::asset('images/{{$game->url}}') }}">"
                    <a href="#" class="subject" >
                        {{ $game->Nom}}
                    </a>
                    <div class="option">
                        <a href="/admin/game/modify/{{$game->id}}">Modify Content</a>
                        <a href="/admin/game/delete/{{$game->id}}">Delete</a>
                    </div>
                </li>

            @empty
                <li class="nocontent">Pas de sujets. Publiez votre premier article !</li>
            @endforelse
        </ul>
    </section>
@endsection

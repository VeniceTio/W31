<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@extends('layout/app')
@section('titre','catégories')

@section('content')
    @parent
    <section class="panel">
        <p><a href="/" class="arbre">Accueil</a> / </p>
        <section>
            <ul class="liste">
                @forelse ($categories as $category)
                    <li style="list-style-type: none"><a href="category/{{ $category->id}}" class="category" >{{ $category->name}}</a></li>
                @empty
                    <li class="nocontent">Pas de catégories correspondantes.</li>
                @endforelse
            </ul>
        </section>
    </section>
@endsection

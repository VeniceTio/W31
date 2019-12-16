@extends('layout/app')
@section('titre','Home')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}">

@section('content')
    @parent
    <section class="nav">
        <a href="admin/games/myGames" role="button" aria-label="MyGames">My Games</a>
    </section>
@endsection

@extends('layout/app')
@section('titre','My account')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">


@section('content')
    @parent
        <p>
			Hello {{ $user ?? 'null'}} !<br>
            You're {{$age}} !<br>
			Welcome on your account.
		</p>
		<ul class="liste">
            <li style="list-style-type: none"><a href="/admin/game/myGames" class="button">My Games.</a></li>
			<li style="list-style-type: none"><a href="formpassword" class="button">Change password.</a></li>
			<li style="list-style-type: none"><a href="deleteuser" class="button">Delete my account.</a></li>
            <li style="list-style-type: none"><a href="signout" class="button">Sign out.</a></li>
		</ul>
@endsection

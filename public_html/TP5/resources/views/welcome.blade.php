@extends('layout/app')
@section('titre','My account')


@section('content')
    @parent
        <p>
			Hello {{ $user ?? 'null'}} !<br>
			Welcome on your account.
		</p>
		<ul>
			<li><a href="formpassword">Change password.</a></li>
			<li><a href="deleteuser">Delete my account.</a></li>
		</ul>
        <p><a href="signout">Sign out.</a></p>
@endsection

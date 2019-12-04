<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout/app')
@section('titre','Signin')
@section('content')
    @parent
		<form action="authenticate" method="post">
            @csrf
			<label for="login">Login</label>       <input type="text"     id="login"    name="login"    required autofocus>
			<label for="password">Password</label> <input type="password" id="password" name="password" required>
			<input type="submit" value="Signin">
		</form>
		<p>
			If you don't have an account, <a href="signup">signup</a> first.
		</p>
@endsection


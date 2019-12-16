<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout/app')
@section('titre','Signup')


@section('content')
    @parent
		<form action="adduser" method="post">
            @csrf
			<label for="login">Login</label>              <input type="text"     id="login"    name="login"    required autofocus>
            <label for="age">Age</label><input type="number" id="age" name="age" required>
			<label for="password">Password</label>        <input type="password" id="password" name="password" required>
			<label for="confirm">Confirm password</label> <input type="password" id="confirm"  name="confirm"  required>
			<input type="submit" value="Signup">
		</form>
		<p>
			If you already have an account, <a href="signin">signin</a>.
		</p>
@endsection
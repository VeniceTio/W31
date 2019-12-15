<link rel="stylesheet" href="{{ URL::asset('css/sign.css') }}">
@extends('layout/app')
@section('titre','Signin')
@section('content')
    @parent
		<form id="connectUserForm" action="authenticate" role="form" method="post">
            @csrf
            <fieldset>
                <label class="fs_title" for="login">Identifiez-vous</label>
                <input type="text" id="login" name="login" placeholder="Pseudo" required autofocus>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <h4>@include('../shared/message')</h4>
                <input type="submit" value="Signin">
                <p>
                    If you don't have an account, <a href="signup">signup</a> first.
                </p>
            </fieldset>
		</form>

@endsection


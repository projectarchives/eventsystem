@extends('layouts.master')

@section('contents')
<article>
<h1>Register To Event Manager</h1>
{{ Form::open(['url' => 'register']) }}
	<ul>
	    {{ $errors->first('message') }}
        <li>
            {{ Form::label('Username', 'Username:') }}
            {{ Form::text('username', null, ['id' => 'username', 'size' => '40'], Input::old('username')) }}
        </li>
        {{ $errors->first('username') }}
        <li>
            {{ Form::label('Email', 'Email:') }}
            {{ Form::text('email', null, ['id' => 'email', 'size' => '40'], Input::old('email')) }}
        </li>
        {{ $errors->first('email') }}
        <li>
            {{ Form::label('Name', 'Full Name:') }}
            {{ Form::text('name', null, ['id' => 'name', 'size' => '40'], Input::old('name')) }}
        </li>
        {{ $errors->first('name') }}
        <li>
            {{ Form::label('Password', 'Password:') }}
            {{ Form::password('password', ['id' => 'password', 'size' => '20']) }}
        </li>
        {{ $errors->first('password') }}
        <li>
            {{ Form::label('PasswordAgain', 'Password Again:') }}
            {{ Form::password('password_confirmation', ['id' => 'password_confirmation', 'size' => '20']) }}
        </li>
        {{ $errors->first('password_confirmation') }}

	</ul>
    <p>
        {{ Form::button('Register',['type' => 'submit', 'class' => 'action']) }}
    </p>
</form>
</article>
@stop
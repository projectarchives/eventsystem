@extends('layouts.master')

@section('contents')
<article>
<h1>Welcome To Event Manager</h1>
{{ Form::open(['url' => 'login']) }}
	<ul>
        <li>
            {{ Form::label('Username', 'Username:') }}
            {{ Form::text('username', null, ['id' => 'username', 'size' => '30'], Input::old('username')) }}
        </li>
        {{ $errors->first('username') }}
        <li>
            {{ Form::label('Password', 'Password:') }}
            {{ Form::password('password', ['id' => 'password', 'size' => '30']) }}
        </li>
        {{ $errors->first('password') }}
	</ul>
    <p>
        {{ Form::button('Login',['type' => 'submit', 'class' => 'action']) }}
        {{ Form::button('Register',['type' => 'submit', 'class' => 'right']) }}
    </p>
</form>
</article>
@stop
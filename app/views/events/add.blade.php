@extends('layouts.master')

@section('contents')
<article>
<h1>Events </h1>
{{ Form::open(['url' => 'events/store']) }}
	<ul>
        <li>
            {{ Form::label('EventName', 'Event Name:') }}
            {{ Form::text('name', null, ['id' => 'name', 'size' => '40']) }}
        </li>
        <li>
            {{ Form::label('EventDetail', 'Details:') }}
            {{ Form::textarea('details', null, ['id' => 'details', 'cols' => '40', 'rows' => '5']) }}
        </li>
        <li>
            {{ Form::label('EventDate', 'Date:') }}
            {{ Form::input('date', 'event_date', Carbon\Carbon::now()->format('Y-m-d')) }}
		</li>
	</ul>
    <p>
        {{ Form::button('Save',['type' => 'submit', 'class' => 'action']) }}
        {{ Form::button('Reset',['type' => 'reset', 'class' => 'right']) }}
    </p>
        @if (Session::has('message'))
            {{ Session::get('message') }}
        @endif
{{ Form::close() }}
</article>
@stop
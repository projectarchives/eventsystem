@extends('layouts.master')

@section('contents')
<article>
<h1>Events </h1>

@if ($data == 'add')
    {{ Form::open(['url' => 'events/store']) }}
    {{--*/ $nameText = null /*--}}
    {{--*/ $detailText = null /*--}}
@else
    {{ Form::open(['url' => 'events/update/'.$data->event_id]) }}

    {{--*/ $nameText = $data->event_name /*--}}
    {{--*/ $detailText = $data->event_detail /*--}}
@endif
	<ul>
	        {{ $errors->first('messages') }}
        <li>
            {{ Form::label('EventName', 'Event Name:') }}
            {{ Form::text('name', $nameText, ['id' => 'name', 'size' => '40']) }}
        </li>
        <li>
            {{ Form::label('EventDetail', 'Details:') }}
            {{ Form::textarea('details', $detailText, ['id' => 'details', 'cols' => '40', 'rows' => '5']) }}
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

{{ Form::close() }}
</article>
@stop
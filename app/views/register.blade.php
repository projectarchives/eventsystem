@extends('layouts.master')

@section('contents')
<article>
<h1>Register To Event Manager</h1>
{{ Form::open(['url' => 'register']) }}
	<ul>
        <li>
        	<label for="name">Your Name:</label>
            <input type="text" size="40" id="name" />
        </li>
        <li>
        	<label for="email">Your Email:</label>
            <input type="email" size="40" id="email" />
        </li>
        <li>
            <label for="car">What's my options:</label>
            <select id="car">
                <option>Volvo</option>
                <option>Saab</option>
                <option>Mercedes</option>
                <option>Audi</option>
                <option>Other&hellip;</option>
            </select>
        </li>
        <li>
            <label><input type="radio" name="radio" /> Pick one</label>
            <label><input type="radio" name="radio" /> And stick with it</label>
        </li>
        <li>
			<label><input type="checkbox" /> Can haz tickbox?</label>
        </li>
        <li>
            <label>Upload a file:</label>
            <input type="file" />
        </li>
        <li>
        	<label for="message">Message:</label>
            <textarea cols="50" rows="5" id="message"></textarea>
		</li>
	</ul>
    <p>
        <button type="submit" class="action">Call to action</button>
        <button type="reset" class="right">Reset</button>
    </p>
</form>
</article>
@stop
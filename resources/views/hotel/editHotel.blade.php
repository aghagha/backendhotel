@extends('base.base')

@section('title', 'Edit Hotel')

@section('content')
	<div>
		<h2>{{ $hotelname }}</h2>
		<ul>
			<li>{{ $city }}</li>
			<li>Hotelid : {{ $hotelid }}</li>
			<li>Website : {{ $website }}</li>
			{!! Form::open(array('url' => 'hotel/upload', 'method'=>'POST', 'files'=>true)) !!}
				<h3>Upload Image of the hotel:</h3>
				{{ Form::file('image') }}<br>
				{{ Form::checkbox('thumbnail', 'yes') }}Save as hotel's thumbnail<br>
				{{ Form::hidden('hotelid', $hotelid) }}
				{{ Form::hidden('hotelname', $hotelname) }}
				{{ Form::hidden('city', $city) }}
				{{ Form::hidden('website', $website) }}
				{{ Form::submit('Upload') }}
			{!! Form::close() !!}
			
			<!-- Show the images here -->
		</ul>
	</div>
@endsection
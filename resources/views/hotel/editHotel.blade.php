@extends('base.base')

@section('title', 'Edit Hotel')

@section('content')
	<div>
		<h2>{{ $hotelname }}</h2>
		<ul>
			<li>{{ $city }}</li>
			<li>Hotelid : {{ $hotelid }}</li>
			<li>Website : {{ $website }}</li>
			<!-- Show the images here -->
			@foreach($images as $image)
				<img src="{{ URL::to('/uploads/'.$image->image_url) }}">
			@endforeach

			@if(Session::has('success'))
	          {!! Session::get('success') !!}
	        @endif
			{!! Form::open(array('url' => 'hotel/upload', 'method'=>'POST', 'files'=>true)) !!}
				<h3>Upload Image of the hotel:</h3>
				@if(Session::has('error'))
					<br>
					<p>{!! Session::get('error') !!}</p>
				@endif
				{{ Form::file('image') }}<br>
				{{ Form::checkbox('thumbnail', 'yes') }}Save as hotel's thumbnail<br>
				{{ Form::hidden('hotelid', $hotelid) }}
				{{ Form::hidden('hotelname', $hotelname) }}
				{{ Form::hidden('city', $city) }}
				{{ Form::hidden('website', $website) }}
				{{ Form::submit('Upload') }}
			{!! Form::close() !!}
		</ul>
	</div>
@endsection
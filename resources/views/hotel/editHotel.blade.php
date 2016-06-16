@extends('base.base')

@section('title', 'Edit Hotel')

@section('content')
	<div>
		<h5>{{ $hotels->startdate }} to {{ $hotels->enddate }}, with keyword {{ $parameters['keyword']}} search result.</h5>
			<!-- 
				hotelid, hotelname, address, city, phone, fax, email, star, remarks, website, pricecurrency, minimumsellprice, allotment
			 -->
			{{ $hotel->hotelname }}
			<ul>
				<li>Hotelid : {{ $hotel->hotelid }}</li>
				<li>City : {{ $hotel->city }}</li>
				<li>{{ $hotel->address }}</li>
				<li>Phone : {{ $hotel->phone }}</li>
				<li>Fax : {{ $hotel->fax }}</li>
				<li>Email : {{ $hotel->email }}</li>
				<li>Star : {{ $hotel->star }}</li>
				<li>Remarks : {{ $hotel->remarks }}</li>
				<li>Website : {{ $hotel->website }}</li>
				<li>Price Currency : {{ $hotel->pricecurrency }}</li> 
				<li>Minimum Sell Price : {{ $hotel->minimumsellprice }}</li>
				<li>Allotment : {{ $hotel->allotment }}</li>
				{!! Form::open(array('url' => 'hotel/upload', 'method'=>'POST', 'files'=>true)) !!}
					{{ Form::file('image') }}
					{{ Form::checkbox('thumbnail', 'yes') }}
					{{ Form::hidden('hotelid', $hotel->hotelid) }}
					{{ Form::submit('Upload') }}
				{!! Form::close() !!}
			</ul>
	</div>
@endsection
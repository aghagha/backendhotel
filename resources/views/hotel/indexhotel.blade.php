@extends('base.base')

@section('title', 'Beranda')

@section('content')
	<div>
		{!! Form::open(array('url'=>'hotel/search', 'method' => 'POST')) !!}
			{{ Form::text('keyword', '', array('placeholder'=>'Search..')) }}
			{{ Form::date('startdate') }}
			{{ Form::date('enddate') }}
			{{ Form::submit('Search') }}
		{!! Form::close() !!}
		
		<ul>
			<!-- 
				hotelid, hotelname, address, city, phone, fax, email, star, remarks, website, pricecurrency, minimumsellprice, allotment
			 -->
			@if(Session::has('notfound'))
	          <br>{!! Session::get('notfound') !!}
	        @endif
			@if(@hotels==!null)
				@foreach($hotels->hotels as $hotel)
					<li><a href="{{ route('hotel.getroom', ['hotelid'	=>$hotel->hotelid,
															'startdate'	=>$parameters['startdate'],
															'enddate'	=>$parameters['enddate']]) }}">{{ $hotel->hotelname }}</a>
						<ul>
							<li><img src="{{ URL::to($hotel->thumb) }}"></li>
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
							<a href="{{ route('hotel.edit', ['hotelid'	=>$hotel->hotelid, 
															'hotelname'	=>$hotel->hotelname,
															'city'		=>$hotel->city,
															'website'	=>$hotel->website]) }}">Edit</a>
						</ul>
						<br>
					</li>
				@endforeach
			@endif
		</ul>
	</div>
@endsection
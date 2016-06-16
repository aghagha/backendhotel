@extends('base.base')

@section('title', 'Beranda')

@section('content')
	<div>
		<h5>{{ $hotels->startdate }} to {{ $hotels->enddate }}, with keyword {{ $parameters['keyword']}} search result.</h5>
		<ul>
			<!-- 
				hotelid, hotelname, address, city, phone, fax, email, star, remarks, website, pricecurrency, minimumsellprice, allotment
			 -->
			@foreach($hotels->hotels as $hotel)
				<li>{{ $hotel->hotelname }}
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
						<a href="{{ route('hotel.edit', ['hotelid'=>$hotel->hotelid]) }}">Edit</a>
					</ul>
					<br>
				</li>
			@endforeach
		</ul>
	</div>
@endsection
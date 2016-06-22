@extends('base.base')

@section('title', 'Kamar Hotel')

@section('content')
	<div>
		{{ $GLOBALS['signature']}}
		@foreach($rooms->rates as $roomrate )
			Ratecode: {{ $roomrate->ratecode }}<br>
			No cancel: {{ $roomrate->nocancel }}<br>
			Promo: {{ $roomrate->promo }}<br>
			Rooms:
			@foreach($roomrate->rooms as $room)
				<ul>
					{{ $room->roomname }}
					<li>{{ $room->pricecurrency }} {{ $room->sellprice }}</li>
					<li>Allotment: {{ $room->allotment }}</li>
					
					<a href="">Pesan</a>
				</ul>
			@endforeach
		@endforeach
	</div>
@endsection
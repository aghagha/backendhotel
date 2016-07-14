@extends('base.base')

@section('title', 'Kamar Hotel')

@section('content')
	<div>
		
		@foreach($rooms->rates as $roomrate )
			Ratecode: {{ $roomrate->ratecode }}<br>
			No cancel: {{ $roomrate->nocancel }}<br>
			Promo: {{ $roomrate->promo }}<br>
			Rooms:
			@foreach($roomrate->rooms as $room)
				<ul>
					{{ $room->roomname }} , {{ $room->roomsellcode }}
					<li>{{ $room->pricecurrency }} {{ $room->sellprice }}</li>
					<li>Allotment: {{ $room->allotment }}</li>
					{!! Form::open(array('url'=>'hotel/sellroom', 'method'=>'POST')) !!}
						Quantity: {{ Form::text('quantity', '', array('placeholder'=>'quantity..')) }}
						{{ Form::hidden('roomsellcode', $room->roomsellcode ) }}
						{{ Form::hidden('signature', $signature) }}
						{{ Form::hidden('agentid', $agentid) }}
						{{ Form::submit('Pesan') }}
					{!! Form::close() !!}
				</ul>
			@endforeach
		@endforeach
	</div>
@endsection
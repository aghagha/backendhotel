@extends('base.base')

@section('title', 'Kamar Hotel')

@section('content')
<?php $now = 'hotel'; ?>
	@extends('base.sidebar')

	@extends('base.header')


	@extends('base.navbar')
	<div class="mainbar">
  
      <!-- Page heading -->
      <div class="page-head">
        <h2 class="pull-left"><i class="fa fa-home"></i> Dashboard</h2>

                <!-- Breadcrumb -->
                <div class="bread-crumb pull-right">
                  <a href="index.html"><i class="fa fa-home"></i> Admin</a> 
                  <!-- Divider -->
                  <span class="divider">/</span> 
                  <a href="#" class="bread-current">Dashboard</a>
                </div>

                <div class="clearfix"></div>

  	</div>	
  	 <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12"> 
              <!-- List starts -->
              <div class="widget">
                <div class="widget-head">
                  <div class="pull-left">
                    <h2>
                      {{$rooms->hotel->hotelname}} Rooms
                    </h2>
                  </div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div> 
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div>
						@foreach($rooms->rates as $roomrate )
                Ratecode: {{ $roomrate->ratecode }}<br>
                No cancel: {{ $roomrate->nocancel }}<br>
                Promo: {{ $roomrate->promo }}<br>
                Rooms:
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <th>Nama kamar</th>
                  <th>Harga</th>
                  <th>Discount</th>
                  <th>Kuota</th>
                  <th>Pesan</th>
                </thead>
                <tbody>
  							@foreach($roomrate->rooms as $room)
                  <td>{{ $room->roomname }}</td>
                  <td>{{ $room->pricecurrency }} {{ $room->sellprice }}</td>
                  <td>{{ $room->discount }}</td>
                  <td>{{ $room->allotment }}</td>
                  <td>{!! Form::open(array('url'=>'hotel/sellroom', 'method'=>'POST', 'class'=>'table-inline')) !!}
                        <div class="form-group">
                          {{ Form::text('quantity', '', array('placeholder'=>'Quantity', 'class'=>'form-control')) }}
                        </div>
                        {{ Form::hidden('roomsellcode', $room->roomsellcode ) }}
                        {{ Form::hidden('signature', $signature) }}
                        <div class="form-group">
                          {{ Form::hidden('agentid', $agentid) }}
                          {{ Form::submit('Pesan',array('class'=>'btn btn-primary')) }}  
                        </div>
                      {!! Form::close() !!}</td>
  							@endforeach
                </tbody>
              </table>
						@endforeach
					</div>
                  </div>
                </div>
              </div> 
            </div>
          </div>
        </div>
    </div>

    <!-- Matter ends -->

    </div>

   <!-- Mainbar ends -->
   <div class="clearfix"></div>

</div>
<!-- Content ends -->

<!-- Footer starts -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
            <!-- Copyright info -->
            <p class="copy">Copyright &copy; 2012 | <a href="#">Your Site</a> </p>
      </div>
    </div>
  </div>
</footer>   

<!-- Footer ends -->

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 

@endsection
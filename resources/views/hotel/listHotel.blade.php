@extends('base.base')

@section('title', 'Manajemen Hotel - List Hotel')

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8"> -->
  <!-- Title and other stuffs -->
  <!-- <title>Dashboard - MacAdmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content=""> -->

  <!-- Favicon -->
  <!-- <link rel="shortcut icon" href="img/favicon/favicon.png">
</head> -->
<!-- @inlcude('base.style') -->
@section('content')

  <?php $now = 'hotel'; ?>
  @include('base.navbar')
 


<!-- Header starts -->
  @include('base.header')

<!-- Header ends -->

<!-- Main content starts -->



  	<!-- Sidebar -->
    @include('base.sidebar')

    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left"><i class="fa fa-home"></i> Daftar Hotel</h2>

                <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

    <div class="matter" style="padding:10px; padding-top:0px;">
        <div class="container" style="padding:10px; padding-top:0px;">
          <div class="row widget">
            <div class="widget-head">
              <div class="pull-left">
                List Hotel
              </div>
              <div class="widget-icons pull-right">
                <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                <a href="#" class="wclose"><i class="fa fa-times"></i></a>
              </div> 
              <div class="clearfix"></div>
            </div>
            <div class="widget-content">
              <div class="padd">
                <div class="col-md-12">
                  <div>
                    {!! Form::open(array('url'=>'hotel/search', 'method' => 'POST', 'class'=>'form-inline')) !!}
                      <div class="form-group">
                        {{ Form::text('keyword', '', array('placeholder'=>'Search..', 'class'=>'form-control')) }}  
                      </div>
                      <div class="form-group">
                        <div id="datetimepicker1" class="input-append input-group dtpicker">
                          {{ Form::text('startdate', '', array('data-format' => 'yyyy-MM-dd','class'=>'form-control', 'placeholder'=>'Start date')) }}
                          <span class="input-group-addon add-on">
                            <i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar"></i>
                          </span>
                        </div>  
                      </div>
                      <div class="form-group">
                        <div id="datetimepicker2" class="input-append input-group dtpicker">
                          {{ Form::text('enddate', '', array('data-format' => 'yyyy-MM-dd','class'=>'form-control', 'placeholder'=>'End date')) }}
                          <span class="input-group-addon add-on">
                            <i data-time-con="fa fa-times" data-date-icon="fa fa-calendar"></i>
                          </span>
                        </div>
                      </div>
                      {{ Form::hidden('page','') }}
                      {{ Form::submit('Search',array('class'=>'btn btn-primary')) }}
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
              <br>
              <div class="padd">
                <div class="page-tables">
                  <div class="table-striped">
                    <table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                      <thead>
                        <th></th>
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Website</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach($hotels->hotels as $hotel)
                          <tr style="border-bottom:2px solid rgba(208, 71, 200, 0.53);padding: 0px 3px;border-radius: 3px;">
                            <td><img src="{{ URL::to($hotel->thumb) }}" class="img-thumbnail" width="100" height="100"></td>
                            <td> {{$hotel->hotelname}} </td>
                            <td> {{$hotel->city}} </td>
                            <td> {{$hotel->address}} </td>
                            <td> {{$hotel->phone}} </td>
                            <td> {{$hotel->website}} </td>
                            <td>
                              <a href="#myModal{{$hotel->hotelid}}" data-toggle="modal"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"style="text-decoration:none"></i></button></a><br>
                              <a href="{{ route('hotel.images', ['hotelid'  =>$hotel->hotelid, 
                                                                  'hotelname' =>$hotel->hotelname,
                                                                  'city'    =>$hotel->city,
                                                                  'website' =>$hotel->website]) }}" ><button class="btn btn-xs btn-primary"><i class="fa fa-camera"></i></button></a>
                              <a href=""><button class="btn btn-xs btn-primary"><i class="fa fa-globe"></i></button></a><br>
                              <a href="{{ route('hotel.getroom', ['hotelid'=>$hotel->hotelid,
                                                                    'stardate'=>$parameters['startdate'],
                                                                    'enddate'=>$parameters['enddate']]) }}"><button class="btn btn-xs btn-success"><i class="fa fa-home"></i></button></a></td>
                      <!-- Modal -->
                            <div id="myModal{{$hotel->hotelid}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                      <h4 class="modal-title">
                                        <strong>{{$hotel->hotelname}}</strong></h4>
                                        @for($i=0; $i<$hotel->star;$i++)
                                          <i class="fa fa-star"></i>
                                        @endfor
                                        <br>
                                        ID : {{$hotel->hotelid}}
                                    </div>
                                    <div class="modal-body">
                                      <p>
                                        <i class="fa fa-building-o"></i>&emsp;{{$hotel->address}}<br>
                                        <i class="fa fa-building-o"></i>&emsp;{{$hotel->city}}<br>
                                        <i class="fa fa-phone"></i>&emsp; {{$hotel->phone}}<br>
                                        <i class="fa fa-phone"></i>&emsp; {{$hotel->fax}}(fax)<br>
                                        <i class="fa fa-envelope-o"></i>&emsp;{{$hotel->email}}<br>
                                        <i class="fa fa-external-link"></i>&emsp;{{$hotel->website}}<br>
                                        <i class="fa fa-info"></i>&emsp;  {{$hotel->remarks}}
                                      </p>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    </div>
                                  </div>
                              </div>
                            </div>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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

<!-- JS -->


@endsection
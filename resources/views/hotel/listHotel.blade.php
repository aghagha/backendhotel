@extends('base.base')

@section('title', 'Beranda')

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
@extends('base.style')
@section('content')

  <?php $now = 'hotel'; ?>
  @extends('base.sidebar')
 


<!-- Header starts -->
  @extends('base.header')

<!-- Header ends -->

<!-- Main content starts -->



  	<!-- Sidebar -->
    @extends('base.navbar')

    <!-- Sidebar ends -->

  	  	<!-- Main bar -->
  	<div class="mainbar">
      
	    <!-- Page heading -->
	    <div class="page-head">
	      <h2 class="pull-left"><i class="fa fa-home"></i> List Hotel</h2>

                <!-- Breadcrumb -->
                <div class="bread-crumb pull-right">
                  <a href="index.html"><i class="fa fa-home"></i> Admin</a> 
                  <!-- Divider -->
                  <span class="divider">/</span> 
                  <a href="#" class="bread-current">Dashboard</a>
                </div>

                <div class="clearfix"></div>

	    </div>
	    <!-- Page heading ends -->



	    <!-- Matter -->

    <div class="matter">
        <div class="container">

          <!-- Today status. jQuery Sparkline plugin used. -->

          <div class="row">
            <div class="col-md-12"> 
              <!-- List starts -->
              <div class="widget">
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
                  <div class="container">
                    <br>
                    <div class="row">
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
                            {{ Form::submit('Search',array('class'=>'btn btn-primary')) }}
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                  </div>

                  <table class="table table-striped table-bordered table-hover">
                    <thead>
                      <th></th>
                      <th>Nama</th>
                      <th>Kota</th>
                      <th>Alamat</th>
                      <th>Telepon</th>
                      <th>Website</th>
                      <th>Detail</th>
                      <th>Entri</th>
                      <th>Kamar</th>
                    </thead>
                    <tbody>
                      @foreach($hotels->hotels as $hotel)
                        <tr>
                          <td><img src="{{ URL::to($hotel->thumb) }}" class="img-thumbnail" width="100" height="100"></td>
                          <td> {{$hotel->hotelname}} </td>
                          <td> {{$hotel->city}} </td>
                          <td> {{$hotel->address}} </td>
                          <td> {{$hotel->phone}} </td>
                          <td> {{$hotel->website}} </td>
                          <td><button class="btn btn-xs btn-warning"><a href="#myModal{{$hotel->hotelid}}" data-toggle="modal"><i class="fa fa-pencil"style="text-decoration:none"></i></a> </button></td>
                          <td><button class="btb btn-xs btn"><a href="{{ route('hotel.images', ['hotelid'  =>$hotel->hotelid, 
                                                                                                'hotelname' =>$hotel->hotelname,
                                                                                                'city'    =>$hotel->city,
                                                                                                'website' =>$hotel->website]) }}"><i class="fa fa-camera"></i></a></button></td>
                          <td><button class="btn btn-xs"><a href="{{ route('hotel.getroom', ['hotelid'=>$hotel->hotelid,
                                                                                                        'stardate'=>$parameters['startdate'],
                                                                                                        'enddate'=>$parameters['enddate']]) }}"><i class="fa fa-home"></i></a> </button></td>
                    <!-- Modal -->
                          <div id="myModal{{$hotel->hotelid}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">{{$hotel->hotelname}}</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>
                                      {{$hotel->address}}<br>
                                      {{$hotel->city}}<br>
                                      {{$hotel->phone}}
                                    </p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
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
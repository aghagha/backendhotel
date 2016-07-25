@extends('base.base')

@section('title', 'Dashboard Hotel')

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
@section('content')

  <?php $now = 'index'; ?>
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
	      <h2 class="pull-left"><i class="fa fa-home"></i> Dashboard</h2>
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
              <ul class="today-datas ">
                <!-- List #1 --> 
                <li>
                  <div class="datas-text">{{$count}} Booking</div>
                </li>
                <li>
                  <div class="datas-text">{{$success}} Succes Transaction</div>
                </li>
                <li>
                  <div class="datas-text">0 Conversion</div>
                </li>
                <li>
                  <div class="datas-text">{{$omzet}} Total Omzet</div>
                </li>                                                                                                     
              </ul> 
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
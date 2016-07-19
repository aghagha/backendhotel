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
                      Add Guest to Room
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
                    {{Form::open(array('url'=>'xxxxx', 'method'=>'POST'))}}
                      {{Form::hidden('signature',$output['signature'])}}
                      {{Form::hidden('agentid',$output['agentid'])}}
                      {{Form::hidden('startdate',$output['startdate'])}}
                      {{Form::hidden('enddate',$output['enddate'])}}
                      {{Form::hidden('foreign',$output['foreign'])}}
                      {{$reservationdata=$output->reservationdata[0]}}
                      {{Form::hidden('roomguests['sellkey']',$reservationdata->roomsellcode)}}
                      {{Form::hidden('roomguests['guestname']','',array('class'=>'form-control'))}}
                      {{Form::hidden('roomguests['guesttitle']','',array('class'=>'form-control'))}}
                      @foreach($output->specialrequests)
                        {{Form::checkbox('guestrequests'.$specialrequests->requestcode,$specialrequests->requestcode)}}$specialrequests->requestdesc
                        @if($specialrequests->noteadditional == '1')
                          {{Form::text('additionaltext'.$specialrequests->requestcode)}}
                        @endif
                      @endforeach
                    {{Form::close()}}
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
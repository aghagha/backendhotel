@extends('base.base')

@section('title', $hotelname)

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
                    <h2>Hotel Images</h2>
                  </div>
                  <div class="widget-icons pull-right">
                    <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> 
                    <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                  </div> 
                  <div class="clearfix"></div>
                </div>
                <div class="widget-content">
                  <div class="padd">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="gallery"><a href="{{URL::to($thumb)}}" class="prettyPhoto[pp_gal]"><img src="{{URL::to($thumb)}}" alt=""></a>  </div>
                      </div>
                      <div class="col-md-9">
                        <h3>{{$hotelname}}</h3>
                        <h4>Upload gambar hotel</h4>
                        {!! Form::open(array('url' => 'hotel/upload', 'method'=>'POST', 'files'=>true)) !!}
                          {{ Form::file('image','', array('class'=>'form-control-file')) }}
                          {{ Form::hidden('hotelid', $hotelid) }}
                          {{ Form::hidden('hotelname', $hotelname) }}
                          {{ Form::hidden('city', $city) }}
                          {{ Form::hidden('website', $website) }}
                          {{ Form::checkbox('thumbnail', 'yes') }}Save as hotel's thumbnail<br>
                          {{ Form::submit('Upload') }}
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                  <div class="padd">
                    
                    <div class="gallery">
                      <!-- Full size image link in anchor tag. Thumbnail link in image tag. -->
                      @foreach($images as $image)
                        <a href="{{ URL::to($image) }}" class="prettyPhoto[pp_gal]"><img src="{{ URL::to($image) }}" alt=""></a>
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

<!-- JS -->

@endsection
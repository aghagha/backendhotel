<div class="content">
  <div class="sidebar">
    <div class="sidebar-dropdown"><a href="#">Navigation</a></div>

    <!--- Sidebar navigation -->
    <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->
    <ul id="nav">
      <!-- Main menu with font awesome icon -->
      <li class="<?php if($now == 'index') echo 'open'; ?> "><a href="{{ route('index') }}"><i class="fa fa-home"></i> Dashboard</a>
       
      </li>
      <li class="has_sub <?php if($now == 'hotel') echo 'open'; ?>">
        <a href="#"><i class="fa fa-list-alt"></i> Manajemen Hotel  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
          <li><a href=" {{ route('hotel.list') }} ">List Hotel</a></li>
          <li><a href="">Manajemen Harga</a></li>
        </ul>
      </li>  
      
      <li class="has_sub <?php if($now == 'transaksi') echo 'open'; ?>"><a href="#"><i class="fa fa-bar-chart-o"></i> Transaksi Hotel <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
          <li><a href="{{ route('hotel.transaksihotel') }}">Daftar Booking</a></li>
          <li><a href="">Issued</a></li>
        </ul>
      </li>	
      <li class="<?php if($now == 'finance') echo 'open'; ?>"><a href="#"><i class="fa fa-money"></i> Finance Hotel<span class="pull-right"></span></a>
      </li>
      <li class="<?php if($now == 'refund') echo 'open'; ?>"><a href="#"><i class="fa fa-credit-card"></i> Refund Booking<span class="pull-right"></span></a>
      </li>
    </ul>
</div>
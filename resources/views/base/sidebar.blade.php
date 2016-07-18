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
          <li><a href="widgets2.html">Edit Hotel</a></li>
          <li><a href="">Entri Gambar</a></li>
          <li><a href="widgets3.html">Entri Link Travel Advisor Hotel</a></li>
          <li><a href="widgets3.html">Manajemen Harga</a></li>
        </ul>
      </li>  
      
      <li class="has_sub <?php if($now == 'transaksi') echo 'open'; ?>"><a href="#"><i class="fa fa-table"></i> Transaksi Hotel <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
          <li><a href="tables.html">Booking</a></li>
          <li><a href="dynamic-tables.html">Issued</a></li>
        </ul>
      </li>	
      <li class="has_sub <?php if($now == 'finance') echo 'open'; ?>"><a href="#"><i class="fa fa-table"></i> Finance Hotel<span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
          <li><a href="tables.html">Personal Member</a></li>
          <li><a href="dynamic-tables.html">Company Member</a></li>
        </ul>
      </li>
      <li class="has_sub <?php if($now == 'refund') echo 'open'; ?>">
        <a href="#"><i class="fa fa-list-alt"></i> Refund Booking  <span class="pull-right"><i class="fa fa-chevron-right"></i></span></a>
        <ul>
          <li><a href="widgets1.html">Travel Partner</a></li>
          <li><a href="widgets2.html">Rentcar Partner</a></li>
        </ul>
      </li>
    </ul>
</div>
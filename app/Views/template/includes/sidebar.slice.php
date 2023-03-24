<!-- Put your sidebar here! -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>" class="brand-link">
    <img src="<?php echo base_url(); ?>/public/assets/img/upp-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">UPP Auction Services</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/img/user2-160x160.jpg" id="img_thisUserProfilePicture" class="profile-user-img img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo base_url(); ?>/my-account" class="d-block">
          <span id="lbl_thisUserCompleteName1"></span>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-child-indent nav-flat nav-legacy flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-dashboard" id="nav_dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>DASHBOARD</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-items" id="nav_items" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>AUCTION ITEMS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-payments" id="nav_payments" class="nav-link">
            <i class="nav-icon fas fa fa-dollar"></i>
            <p>AUCTION PAYMENTS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-calendar" id="nav_calendar" class="nav-link">
            <i class="nav-icon fas fa fa-calendar"></i>
            <p>AUCTION CALENDAR</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
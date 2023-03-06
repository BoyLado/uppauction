<!-- Put your sidebar here! -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:void(0)" class="brand-link">
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

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
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
          <a href="<?php echo base_url(); ?>/portal/auction-bidders" id="nav_bidders" class="nav-link">
           <i class="nav-icon fa fa-users" ></i> 
            <p>AUCTION BIDDERS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-items" id="nav_items" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>AUCTION ITEMS</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>/portal/auction-winners" id="nav_winners" class="nav-link">
            <i class="nav-icon fas fa fa-trophy"></i>
            <p>AUCTION WINNERS</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
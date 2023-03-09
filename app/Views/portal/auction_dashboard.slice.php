@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/select2/css/select2.min.css">
<!-- Full Calendar -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fullcalendar/fullcalendar.css">

<style type="text/css">
  /*INTERNAL STYLES*/
  .tbl tr td{
    border : none !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow b
  {
    margin-top: 2px !important;
  }

  .select2-container .select2-selection--single .select2-selection__rendered
  {
    padding-left: 0px !important;
  }

  .select2-container--default .select2-selection--single
  {
    border: 1px solid #ced4da;
  }

#activeusers, #lbl_organizationsCount, #moreinfo{

  color: white !important;
}

  
</style>

@endsection



@section('page_content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header pt-1 pb-1">
    <div class="container-fluid">
     
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="lbl_contactsCount">3</h3>
              <h5>Active Users</h5>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="lbl_campaignsCount">$250</h3>
              <h5><b>Sales</b></h5>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-orange">
            <div class="inner">
              <h3 id="lbl_organizationsCount">14</h3>
              <h5 id="activeusers">Sold Items</h5>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a id="moreinfo" href="#" class="small-box-footer">
              More info <i id="moreinfo" class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
 
        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="lbl_thirdPartiesCount">300</h3>
              <h5>Season Pass Members</h5>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">
              More info <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        </div>
      <div class="row">
        <div class="col-md-9">
        <div class="card-header">
        <div id="div_calendars">
        <hr>
        <center><h5>Loading...</h5></center>
      </div>
    </div>
  </div>
  

  <div class="col-md-3">
      <div class="card">
      <div class="card-header">
      <h3 class="card-title">Latest Members</h3>
      <div class="card-tools">
      <span class="badge badge-danger">8 New Members</span>
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
      <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
      <i class="fas fa-times"></i>
      </button>
      </div>
      </div>

      <div class="card-body p-0">
      <ul class="users-list clearfix">
      <li>
      <img src="dist/img/user1-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Alexander Pierce</a>
      <span class="users-list-date">Today</span>
      </li>
      <li>
      <img src="dist/img/user8-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Norman</a>
      <span class="users-list-date">Yesterday</span>
      </li>
      <li>
      <img src="dist/img/user7-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Jane</a>
      <span class="users-list-date">12 Jan</span>
      </li>
      <li>
      <img src="dist/img/user6-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">John</a>
      <span class="users-list-date">12 Jan</span>
      </li>
      <li>
      <img src="dist/img/user2-160x160.jpg" alt="User Image">
      <a class="users-list-name" href="#">Alexander</a>
      <span class="users-list-date">13 Jan</span>
      </li>
      <li>
      <img src="dist/img/user5-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Sarah</a>
      <span class="users-list-date">14 Jan</span>
      </li>
      <li>
      <img src="dist/img/user4-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Nora</a>
      <span class="users-list-date">15 Jan</span>
      </li>
      <li>
      <img src="dist/img/user3-128x128.jpg" alt="User Image">
      <a class="users-list-name" href="#">Nadia</a>
      <span class="users-list-date">15 Jan</span>
      </li>
      </ul>

      </div>

      <div class="card-footer text-center">
      <a href="javascript:">View All Users</a>
      </div>
      </div>
      <div class="card">
        <div class="card-header border-0">
        <h3 class="card-title">Auction Product</h3>
        <div class="card-tools">
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-valign-middle">
        <thead>
        <tr>
        <th>Product No.</th>
        <th>Winning Amount</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>
        #1
        </td>
        <td>$13</td>
        <td>
        Paid
        </td>
        </a>
        </td>
        </tr>
        <tr>
        <td>
        #2
        </td>
        <td>$29</td>
        <td>
        Unpaid
        </td>
        </tr>
        <tr>
        <td>
        #3
        </td>
        <td>$100</td>
        <td>
        Paid
        </td>
        </tr>
        <tr>
        <td>
        #4
        </td>
        <td>$49</td>
        <td>
        Unpaid
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </div>
    </div>

<!-- /.container flued -->
  </div><!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer pt-2 pb-2">
  <center><strong>Copyright &copy; 2023 <a href="#">U PICK A PALLET LLC</a>.</strong></center>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
  </div>
  <!-- <center>
    <button type="button" class="btn btn-info btn-sm"><i class="fa fa-save mr-1"></i> Save</button>
    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-times mr-1"></i> Cancel</button>
  </center> -->
</footer>

@endsection



@section('custom_scripts')

<!-- Plugins -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/select2/js/select2.full.min.js"></script>

<!-- FullCallendar -->
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/moment/moment-timezone-with-data.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fullcalendar/fullcalendar.js"></script>

<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/js/portal/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events

    //sideNav active/inactive

    $('.nav-item').removeClass('menu-open');
    $('.nav-link').removeClass('active');
    $('#nav_dashboard').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-th mr-2"></i>
                  <b>DASHBOARD</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //
    let objCalendar = new FullCalendar.Calendar(document.getElementById(`div_calendars`),{
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap'
    });
    objCalendar.render();

  });
</script>

@endsection

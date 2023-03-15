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
  
</style>

@endsection



@section('page_content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header pt-1 pb-1">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">

          <div class="mt-1 float-left">
            <!-- <input type="search" class="form-control form-control-sm" id="txt_searchBidder" name="txt_searchBidder" placeholder="Search Bidder"> -->
            <h5>Auction Events</h5>
          </div>
          
          <div class="mt-1 float-right">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_addAuctionEvent">
                  <i class="fa fa-plus mr-1"></i>Add Auction Event
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_addAuctionEvent">
                <i class="fa fa-plus mr-1"></i> Add Auction Event
              </button>
            </div>
          </div>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <!-- Start UI Content -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div id="div_calendars"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_auctionEvent" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-plus mr-1"></i> Add New Event</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_auctionEvent">
                <input type="hidden" id="txt_auctionId" name="txt_auctionId">
                <label>Auction Event Title:</label>
                <input type="text" class="form-control" id="txt_title" name="txt_title">
                <label>Auction Event Details:</label>
                <textarea class="form-control" rows="3" id="txt_description" name="txt_description"></textarea>
                <label>Auction Date</label>
                <input type="date" class="form-control" id="txt_date" name="txt_date">
              </form>

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" id="btn_saveEvent" form="form_auctionEvent">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <br>

      <!-- End UI Content -->

    </div><!-- /.container flued -->
  </div><!-- /.content -->

</div>
<!-- /.content-wrapper -->
<footer class="main-footer pt-2 pb-2">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
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
    $('#nav_calendar').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-calendar mr-2"></i>
                  <b>CALENDAR</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //

    CALENDAR.loadAuctions();

    $('#lnk_addAuctionEvent').on('click',function(){
      $('#modal_auctionEvent').modal('show');
    });

    $('#btn_addAuctionEvent').on('click',function(){
      $('#modal_auctionEvent').modal('show');
    });

    $('#form_auctionEvent').on('submit',function(e){
      e.preventDefault();
      let auctionId = $('#txt_auctionId').val();
      (auctionId == "")? CALENDAR.addAuction(this) : CALENDAR.editAuction(this);
    });

  });
</script>

@endsection

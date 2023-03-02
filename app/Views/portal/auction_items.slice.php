@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/select2/css/select2.min.css">

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

  .hide-scroll::-webkit-scrollbar
  {
    display: none;
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
          <h6 class="mt-1 float-left">
            <span>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">Contacts</a> -
            </span> 
            <small>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">All</a>
            </small>
          </h6>
          <div class="float-right">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_addContacts">
                  <i class="fa fa-plus mr-1"></i>Add Contact
                </a>
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_importContacts">
                  <i class="fa fa-upload mr-1"></i>Import
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_addContacts">
                <i class="fa fa-plus mr-1"></i> Add Contact
              </button>
              <button type="button" class="btn btn-default btn-sm" id="btn_importContacts">
                <i class="fa fa-upload mr-1"></i> Import
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
        <div class="col-sm-12 col-md-12 col-lg-4">
          <h5>Auction Item Details</h5>
          <table class="table mb-0">
            <tbody>
              <tr>
                <td class="p-1">
                  <label>Item Number *:</label>
                  <input type="text" class="form-control" id="txt_editBidderNumber" name="txt_editBidderNumber" required>
                </td>
              </tr>
              <tr>
                <td class="p-1">
                  <label>Item Description *:</label>
                  <textarea class="form-control" rows="5" id="txt_address" name="txt_address"></textarea>
                </td>
              </tr>
              <tr>
                <td class="p-1">
                  <label>Bidder Number/Name *:</label>
                  <select class="form-control form-select select2" style="width: 100%;">
                    <option value="">Choose Bidder</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="p-1">
                  <label>Amount:</label>
                  <input type="text" class="form-control" id="txt_phoneNumber" name="txt_phoneNumber">
                </td>
              </tr>
              <tr>
                <td class="p-1">
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary">Next Item</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-8"></div>
      </div>

      <div class="hide-scroll" style="width:100%; height: 100vh; overflow:scroll; scroll-behavior: hidden;">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6">
            
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6"></div>
        </div>
      </div>



      








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

<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/js/portal/{{ $customScripts }}.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //jQuery Events

    //sideNav active/inactive

    $('.nav-item').removeClass('menu-open');
    $('.nav-link').removeClass('active');
    $('#nav_items').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-list mr-2"></i>
                  <b>AUCTION ITEMS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //


  });
</script>

@endsection

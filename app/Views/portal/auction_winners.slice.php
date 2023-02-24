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
              <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            
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


<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

 
<div class="row" data-target="#exampleModalLong">
  <div class="col-md-6 col-lg-6 col-xl-3 pt-2">
    <div class="card mb-2 bg-gradient-dark zoom">
      <a href="javascript:void(0)" id="winner1">
        <img class="card-img-top rounded" data-target="#exampleModalLong" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
        <div class="products">
          <h5 class="card-title text-primary text-white">
            <span class="text-bold text-white">Bidder Name: Mr Bean</span> <br>
            <span class="text-bold text-red">Bidder #001</span>      <br>
            <span class="card-text text-white">Address</span>
          </h5>
          <div class="float-right">
            <a href="#" onclick="alert('Under Construction')" >Edit</a> |
            <a href="#" onclick="alert('Under Construction')" >Delete</a>
          </div>
        </div>
      </a>
    </div>
  </div>

<div class="col-md-6 col-lg-6 col-xl-3 pt-2">
    <div class="card mb-2 bg-gradient-dark zoom">
      <a href="javascript:void(0)" id="winner2">
        <img class="card-img-top rounded" data-target="#exampleModalLong" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
        <div class="products">
         <h5 class="card-title text-primary text-white">
            <span class="text-bold text-white">Bidder Name: Mr Bean</span> <br>
            <span class="text-bold text-red">Bidder #002</span>      <br>
            <span class="card-text text-white">Address</span>
          </h5>
          <div class="float-right">
            <a href="#" onclick="alert('Under Construction')" >Edit</a> |
            <a href="#" onclick="alert('Under Construction')" >Delete</a>
          </div>
        </div>
      </a>
    </div>
  </div>

 <div class="col-md-6 col-lg-6 col-xl-3 pt-2">
    <div class="card mb-2 bg-gradient-dark zoom">
      <a href="javascript:void(0)" id="winner3">
        <img class="card-img-top rounded" data-target="#exampleModalLong" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
        <div class="products">
          <h5 class="card-title text-primary text-white">
            <span class="text-bold text-white">Bidder Name: Mr Bean</span><br>
            <span class="text-bold text-red">Bidder #003</span><br>
            <span class="card-text text-white">Address</span>
          </h5>
          <div class="float-right">
            <a href="#" onclick="alert('Under Construction')" >Edit</a> |
            <a href="#" onclick="alert('Under Construction')" >Delete</a>
          </div>
        </div>
      </a>
    </div>
  </div>
<div class="col-md-6 col-lg-6 col-xl-3 pt-2">
    <div class="card mb-2 bg-gradient-dark zoom">
      <a href="javascript:void(0)" id="winner4">
        <img class="card-img-top rounded" data-target="#exampleModalLong"src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
        <div class="products">
          <h5 class="card-title text-primary text-white">
            <span class="text-bold text-white">Bidder Name: Mr Bean</span> <br>
            <span class="text-bold text-red">Bidder #004</span>      <br>
            <span class="card-text text-white">Address</span>
          </h5>
          <div class="float-right">
            <a href="#" onclick="alert('Under Construction')" >Edit</a> |
            <a href="#" onclick="alert('Under Construction')" >Delete</a>
          </div>
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
    $('#nav_winners').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-trophy mr-2"></i>
                  <b>AUCTION WINNERS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //
  $('#winner1').on('click',function(){
  $('#exampleModalLong').modal('show');

  });

  $('#winner2').on('click',function(){
  $('#exampleModalLong').modal('show');

  });

  $('#winner3').on('click',function(){
  $('#exampleModalLong').modal('show');

  });

  $('#winner4').on('click',function(){
  $('#exampleModalLong').modal('show');

  });



  });
</script>

@endsection

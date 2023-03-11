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
  
  .products {
    position: absolute; /* Position the background text */
    bottom: 0; /* At the bottom. Use top:0 to append it to the top */
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.8); /* Black background with 0.5 opacity */
    color: #f1f1f1; /* Grey text */
    width: 100%; /* Full width */
    padding: 15px; /* Some padding */
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
  }

  .zoom { 
  transition: all .2s ease-in-out; 
  }

  .zoom:hover { 

    transform: scale(1.1);
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

          <div class="mt-1 float-left">
            <input type="search" class="form-control form-control-sm" id="txt_searchWinner" name="txt_searchWinner" placeholder="Search Winner">
          </div>
          <div class="mt-1 float-right">
            <div class="form-inline">
              <button class="btn btn-default btn-sm" id="btn_refresh"><i class="fa fa-refresh"></i></button>
              <input type="date" class="form-control form-control-sm" id="txt_dateFilter" name="txt_dateFilter" value="<?php echo date('Y-m-d'); ?>">
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
      <div class="hide-scroll" style="width:100%; height: 100vh; overflow:scroll; scroll-behavior: hidden;">
        <div class="row" id="div_bidders">
          <!-- <div class="col-md-6 col-lg-6 col-xl-3 pt-2">
            <div class="card mb-2 bg-gradient-dark zoom">
              <a href="javascript:void(0)" onclick="alert();">
                <img class="card-img-top rounded" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
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
              <a href="javascript:void(0)" onclick="alert();">
                <img class="card-img-top rounded" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
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
              <a href="javascript:void(0)" onclick="alert();">
                <img class="card-img-top rounded" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
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
              <a href="javascript:void(0)" onclick="alert();">
                <img class="card-img-top rounded" src="<?php echo base_url(); ?>/public/assets/img/1.jpg" alt="" style="height: 300px; width: 100%; object-fit: cover;">
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
              </a>
            </div>
          </div> -->
        </div>
      </div>

      <div class="modal fade" id="modal_bidderDetails" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-circle-info mr-1"></i> Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="lnk_details" data-toggle="pill" href="#div_details" role="tab" aria-controls="div_details" aria-selected="false">Bidder Details</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="lnk_guests" data-toggle="pill" href="#div_guests" role="tab" aria-controls="div_guests" aria-selected="true">Guests</a>
                    </li>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="div_details" role="tabpanel" aria-labelledby="lnk_details">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td>Bidder Number</td>
                            <td><span id="lbl_bidderNumber"></span></td>
                          </tr>
                          <tr>
                            <td>Company Name</td>
                            <td><span id="lbl_companyName"></span></td>
                          </tr>
                          <tr>
                            <td>Bidder Name</td>
                            <td><span id="lbl_bidderName"></span></td>
                          </tr>
                          <tr>
                            <td>Address</td>
                            <td><span id="lbl_address"></span></td>
                          </tr>
                          <tr>
                            <td>Phone Number</td>
                            <td><span id="lbl_phoneNumber"></span></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><span id="lbl_email"></span></td>
                          </tr>
                          <tr>
                            <td>Drivers License</td>
                            <td><span id="lbl_driversLicense"></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane fade" id="div_guests" role="tabpanel" aria-labelledby="lnk_guests">
                      <table class="table table-bordered" id="tbl_guests">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Relation</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>            

            </div>
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
    $('#nav_regBidders').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-users mr-2"></i>
                  <b>REGISTERED BIDDERS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //
    
    BIDDERS.loadRegisteredBidders();

    $('#txt_searchWinner').on('keyup',function(){
      BIDDERS.loadRegisteredBidders($(this).val(), $('#txt_dateFilter').val());
    });

    $('#btn_refresh').on('click',function(){
      BIDDERS.loadRegisteredBidders();
    });

    $('#txt_dateFilter').on('change',function(){
      BIDDERS.loadRegisteredBidders($('#txt_searchWinner').val(), $(this).val());
    });

  });
</script>

@endsection

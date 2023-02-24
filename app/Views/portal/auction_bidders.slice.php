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
          <!-- <h6 class="mt-1 float-left">
            <span>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">Contacts</a> -
            </span> 
            <small>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">All</a>
            </small>
          </h6> -->
          <div class="float-right ">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_addNewBidder">
                  <i class="fa fa-plus mr-1"></i>Add New Bidder
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_addNewBidder">
                <i class="fa fa-plus mr-1"></i> Add New Bidder
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

      <div class="modal fade" id="modal_addBidder" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-plus mr-1"></i> Add New Bidder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_addBidder">

                <label>Bidder Number:</label>
                <input type="text" class="form-control" id="txt_bidderNumber" name="txt_bidderNumber" required>

                <label>ID Picture:</label>
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <div class="text-center bg-light mb-2" id="div_imagePreview">
                      <img class="profile-user-img img-fluid" style="width: 100%; object-fit: cover;" id="img_profilePicture"
                           src="<?php echo base_url(); ?>/public/assets/img/user-placeholder.png"
                           alt="User profile picture">
                    </div> 
                    <div class="info-box-content">
                      <span class="info-box-number">Note:</span>
                      <span class="info-box-text">Accepted files (.jpg, .png, .jpeg)</span>
                    </div>
                    <input type="file" class="form-control" id="file_idPicture" name="file_idPicture" style="padding: 3px 3px 3px 3px !important;" accept="image/*" required>
                    <div class="text-center" id="div_imageDetails">
                      <span id="lbl_fileName"></span><br>
                      <span id="lbl_fileSize"></span><br>
                      <span id="lbl_fileStatus"></span>
                    </div>                  
                  </div>
                </div> 
              </form>

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" form="form_addBidder">Save Bidder</button>
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
    $('#nav_bidders').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-users mr-2"></i>
                  <b>AUCTION BIDDERS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //
    
    BIDDERS.loadBidders();

    $('#lnk_addNewBidder').on('click',function(){
      $('#div_imageDetails').hide();
      $('#modal_addBidder').modal('show');
    });

    $('#btn_addNewBidder').on('click',function(){
      $('#div_imageDetails').hide();
      $('#modal_addBidder').modal('show');
    });

    $('#file_idPicture').on('change',function(){
      BIDDERS.uploadBidderPicturePreview(this);
    });

    $('#form_addBidder').on('submit',function(e){
      e.preventDefault();
      BIDDERS.addBidder(this);
    });

  });
</script>

@endsection

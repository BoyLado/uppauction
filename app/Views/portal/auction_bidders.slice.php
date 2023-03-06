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
            <input type="search" class="form-control form-control-sm" id="txt_searchBidder" name="txt_searchBidder" placeholder="Search Bidder">
          </div>
          
          <div class="mt-1 float-right">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_addNewBidder">
                  <i class="fa fa-plus mr-1"></i>Add New Bidder
                </a>
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_importBiddersSeasonPass">
                  <i class="fa fa-upload mr-1"></i>Import
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_addNewBidder">
                <i class="fa fa-plus mr-1"></i> Add New Bidder
              </button>
              <button type="button" class="btn btn-default btn-sm" id="btn_importBiddersSeasonPass">
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
                <label>ID Picture:</label>
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <div class="text-center" id="div_addImageDetails">
                      <span id="lbl_fileName"></span><br>
                      <span id="lbl_fileSize"></span><br>
                      <span id="lbl_fileStatus"></span>
                    </div>
                    <div class="text-center bg-light mb-2" id="div_addImagePreview">
                      <img class="profile-user-img img-fluid" style="width: 100%; object-fit: cover;" id="img_addIdPicture"
                           src="<?php echo base_url(); ?>/public/assets/img/user-placeholder.png"
                           alt="User profile picture">
                    </div> 
                    <div class="info-box-content">
                      <span class="info-box-number">Note:</span>
                      <span class="info-box-text">Accepted files (.jpg, .png, .jpeg)</span>
                    </div>
                    <input type="file" class="form-control" id="file_addIdPicture" name="file_addIdPicture" style="padding: 3px 3px 3px 3px !important;" accept="image/*" required>                  
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

      <div class="modal fade" id="modal_editBidder" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-plus mr-1"></i> Edit Bidder Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_editBidder">

                <input type="hidden" id="txt_bidderId" name="txt_bidderId">

                <div class="row">
                  <div class="col-sm-12 col-md-5 col-lg-5">
                    <div class="row">
                      <div class="col-lg-12 col-sm-12">
                        <div class="text-center bg-light mb-2" id="div_editImagePreview">
                          <img class="profile-user-img img-fluid" style="width: 100%; object-fit: cover;" id="img_editIdPicture"
                               src="<?php echo base_url(); ?>/public/assets/img/user-placeholder.png"
                               alt="User profile picture">
                        </div> 
                        <div class="info-box-content">
                          <span class="info-box-number">Note:</span>
                          <span class="info-box-text">Accepted files (.jpg, .png, .jpeg)</span>
                        </div>
                        <input type="file" class="form-control" id="file_editIdPicture" name="file_editIdPicture" style="padding: 3px 3px 3px 3px !important;" accept="image/*">
                        <div class="text-center" id="div_editImageDetails">
                          <span id="lbl_fileName"></span><br>
                          <span id="lbl_fileSize"></span><br>
                          <span id="lbl_fileStatus"></span>
                        </div>                  
                      </div>
                    </div> 
                  </div>
                  <div class="col-sm-12 col-md-7 col-lg-7">
                    <table class="table mb-0">
                      <tbody>
                        <tr>
                          <td class="p-1"><label>Bidder Number *:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_editBidderNumber" name="txt_editBidderNumber" required>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>First Name *:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_firstName" name="txt_firstName" required>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>Last Name *:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_lastName" name="txt_lastName" required>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>Address:</label></td>
                          <td class="p-1">
                            <textarea class="form-control" rows="3" id="txt_address" name="txt_address"></textarea>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>Phone Number:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_phoneNumber" name="txt_phoneNumber">
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>Email *:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_email" name="txt_email" required>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>ID/DL Number *:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_idNumber" name="txt_idNumber" required>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-1"><label>Season Pass Link:</label></td>
                          <td class="p-1">
                            <input type="text" class="form-control" id="txt_seasonPassLink" name="txt_seasonPassLink">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </form>

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" form="form_editBidder">Save Changes</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_importSeasonPass" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-upload mr-1"></i> Import Season Pass</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_importSeasonPass" enctype="multipart/form-data">
                <label>CSV File Only:</label>
                <input type="file" class="form-control" id="file_seasonPassList" name="file_seasonPassList" style="padding: 3px 3px 3px 3px !important;" accept=".csv" required>

                <span id="lbl_loader"><br><i>Analizing your file, please wait...</i></span>
                <div class="pt-3" id="div_checkResult">
                  <label>For Update: <span id="lbl_forUpdate"></span></label>
                  <br>
                  <label>For Insert: <span id="lbl_forInsert"></span></label>
                  <br>
                  <label>Conflict Rows: <span id="lbl_conflictRows"></span></label>
                  
                  <p id="lbl_download">
                    Click <a href="#" id="lnk_download" target="_blank">here</a> to download conflict rows.
                  </p>
                </div>
                <div class="pt-3" id="div_errorResult" style="color:red;">
                  <label>Error:</label>
                  <p></p>
                  <br>
                </div>
                <label id="lbl_uploadingProgress" class="text-danger"><i>Uploading in progress, Please wait...</i></label>
              </form>             

            </div>
            <div class="modal-footer modal-footer--sticky">
              <a href="<?php echo base_url(); ?>/public/assets/files/SeasonPassBatchUploadTemplate.xlsx" type="button" class="btn btn-primary">Download CSV Template</a>
              <button type="submit" class="btn btn-primary" id="btn_submitSeasonPassList" form="form_importSeasonPass">Upload Season Pass</button>
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

    $('#txt_searchBidder').on('keyup',function(){
      BIDDERS.loadBidders($(this).val());
    }); 

    $('#lnk_addNewBidder').on('click',function(){
      $('#div_addImageDetails').hide();
      $('#modal_addBidder').modal('show');
    });

    $('#btn_addNewBidder').on('click',function(){
      $('#div_addImageDetails').hide();
      $('#modal_addBidder').modal('show');
    });

    $('#file_addIdPicture').on('change',function(){
      BIDDERS.uploadBidderPicturePreview(this);
    });

    $('#form_addBidder').on('submit',function(e){
      e.preventDefault();
      BIDDERS.addBidder(this);
    });

    $('#form_editBidder').on('submit',function(e){
      e.preventDefault();
      BIDDERS.editBidder(this);
    });

    $('#lnk_importBiddersSeasonPass').on('click',function(){
      $('#lbl_loader').hide();
      $('#div_checkResult').hide();
      $('#lbl_download').hide();
      $('#div_errorResult').hide();
      $('#lbl_uploadingProgress').hide();
      $('#modal_importSeasonPass').modal('show');
    });

    $('#btn_importBiddersSeasonPass').on('click',function(){
      $('#lbl_loader').hide();
      $('#div_checkResult').hide();
      $('#lbl_download').hide();
      $('#div_errorResult').hide();
      $('#lbl_uploadingProgress').hide();
      $('#modal_importSeasonPass').modal('show');
    });

    $('#btn_submitSeasonPassList').prop('disabled',true);

    $('#file_seasonPassList').on('change',function(){
      BIDDERS.checkCSVFile(this);
    });

    $('#form_importSeasonPass').on('submit',function(e){
      e.preventDefault();
      BIDDERS.uploadSeasonPass();
    });

  });
</script>

@endsection

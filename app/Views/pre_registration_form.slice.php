<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pre Registration Form</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="icon" href="<?php echo base_url(); ?>/public/assets/img/upp-logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer">

  <!-- Sweet alert -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Toaster -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/toastr/toastr.min.css">

  <style type="text/css">
    #button 
    {
      margin-top: 25px;
      margin-bottom: 25px;
    }

    #text
    {
      margin-top: 25px;
    }

    #fields
    {
      margin-bottom: 25px;
    }

    #text1
    {
      margin-top: 25px;
    }

    #h2, #h4
    {
      margin-top: 25px;
      text-align: center;
    }

    #nav
    {
      background-color: #6EC1E4;
    }

    #icon
    {
      color: white;
    }
  </style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" id="nav" style="height: 80px;">
    <div class="container">
      <a href="<?php echo base_url(); ?>/public/assets/AdminLTE/index3.html" class="navbar-brand">
        <img src="<?php echo base_url(); ?>/public/assets/img/upp-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <div class="d-none d-lg-inline">
          <span class="brand-text font-weight-bold">U PICK A PALLET LLC</span>
        </div>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li>
          <a class="nav-link" href="#">
            <i class="fa-xl fa-brands fa-instagram"></i>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#">
            <i class="fa-xl fa-brands fa-square-facebook"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">
            <i class="fa-xl fa-brands fa-square-twitter"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">
            <i class="fa-xl fa-brands fa-square-youtube"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">

        <form id="form_preRegistration">
          <h2 id="h2">Auction Pre-Registration</h2>
          <div class="mb-3">
            <h5 id="h4" style="text-align: center;">
              To pre-register to bid onsite at our next auction, please fill out the form below. After we receive your information, we will contact you to complete the registration process.
            </h5>
          </div>

          <div class="row mb-2">
            <div class="col-sm-12 col-md-3 col-lg-3">
              <h3 class="card-title"><b>Auction Date <span class="text-red">*</span></b></h3>
              <select class="form-control form-select" id="slc_auctionDate" name="slc_auctionDate" required>
                <option value="">Choose Date</option>
              </select>
            </div>
          </div>

          <hr>

          <div class="mb-2">
            <h6>Are you a SEASON PASS holder?</h6>
            <div class="row">
              <div class="col-lg-2">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="rdb1" name="rdb_seasonPass" value="1">
                      <label class="form-check-label" for="rdb1">Yes</label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="rdb2" name="rdb_seasonPass" value="0" checked>
                      <label class="form-check-label" for="rdb2">No</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-10"></div>
            </div>
          </div>

          <div id="div_withOutSeasonPass">
            <div class="row mb-2">
              <div class="col-lg-6">
                <label for="txt_companyName">Company Name (Optional)</label>
                <input type="text" class="form-control" id="txt_companyName" name="txt_companyName" placeholder="Company Name">
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-lg-6">
                <label for="txt_firstName">First Name <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="txt_firstName" name="txt_firstName" placeholder="First name">
              </div>
              <div class="col-lg-6">
                <label for="txt_lastName">Last Name <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="txt_lastName" name="txt_lastName" placeholder="Last name">
              </div>
            </div>   

            <div class="row mb-2">
              <div class="col-lg-12">
                <label for="txt_completeAddress">Complete Address <span class="text-red">*</span></label>
                <textarea class="form-control" rows="5" id="txt_completeAddress" name="txt_completeAddress"></textarea>
              </div>
            </div>   
                
            <div class="row mb-2">
              <div class="col-lg-6">
                <label for="txt_phoneNumber">Phone Number</label>
                <input type="text" class="form-control" id="txt_phoneNumber" name="txt_phoneNumber" placeholder="Phone Number">
              </div>
              <div class="col-lg-6">
                <label for="txt_driverLicenseNumber">Driver’s License Number 
                  <span class="text-red">*</span></label>
                <input type="text" class="form-control" id="txt_driverLicenseNumber" name="txt_driverLicenseNumber" placeholder="Driver’s License Number">
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-lg-6">
              <label for="txt_emailAddress">Email Address <span class="text-red">*</span></label>
              <input type="email" class="form-control" id="txt_emailAddress" name="txt_emailAddress" placeholder="Email Address">
            </div>
            <div class="col-lg-6" id="div_seasonPass">
              <label for="txt_seasonPassNumber">Season Pass Number <span class="text-red">*</span></label>
              <input type="text" class="form-control" id="txt_seasonPassNumber" name="txt_seasonPassNumber" placeholder="Season Pass Number">
            </div>
          </div>

          <div id="div_withSeasonPass">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="chk_guests" name="chk_guests" value="guests">
              <label class="form-check-label" for="chk_guests">
                I want to invite guests.
              </label>
            </div>
            <div id="div_guest">
              <label>Guest</label>
              <div class="row guest-form mb-2">
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-2">
                      <button type="button" class="btn btn-primary btn-block" id="btn_addGuest">Add</button>
                    </div>
                    <div class="col-lg-5">
                      <input type="text" class="form-control" name="" placeholder="First Name">
                    </div>
                    <div class="col-lg-5">
                      <input type="text" class="form-control" name="" placeholder="Last Name">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-lg-6">
                      <input type="email" class="form-control" name="" placeholder="Email Address">
                    </div>
                    <div class="col-lg-6">
                      <select class="form-control">
                        <option value="">Relationship</option>
                        <option value="Grand-Father">Grand Father</option>
                        <option value="Grand-Mother">Grand Mother</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Brother">Brother</option>
                        <option value="Sister">Sister</option>
                        <option value="Friend">Friend</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div id="div_otherGuests">
                
              </div>
            </div>
          </div>

          <hr>
              
          <label lass="gfield_label gform-field-label gfield_label_before_complex">
            I AGREE TO THE BUYERS CONTRACT
            <span class="gfield_required">
              <span class="gfield_required gfield_required_asterisk text-red"> *</span>
            </span>
          </label>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="chk_agree" name="chk_agree" value="agree">
            <label class="form-check-label" for="chk_agree">
              <h5>BY CONSENTING AND BIDDING YOU ARE ACKNOWLEDGING AGREEMENT WITH THE TERMS BELOW.</h5>
            </label>
          </div>

          <div class="mb-3 p-2" style="height: 35vh; overflow-y:hidden; width: 100%; border: 1px solid black;">
            <center><h5>Auction Terms and conditions</h5></center>
            <p style="text-align: justify;">All items sold in U Pick A Pallet auctions are sold “as is” and we do not accept refunds or exchanges on any auction items. It is your responsibility to fullfill your purchase obligation before exiting the auction. U Pick A Pallet will not be held responsible for any accidents that may occur physical or emotional. All attendees are required to be present with a season pass holder. I consent to U Pick A Pallet season pass holder terms and conditions as well as the terms and conditions applied to  U Pick A Pallet LLC. I understand that all items are sold “as is” and I will not attempt to perform any form of chargeback from the use of debit or credit card. I understand and consent to the fee of 4.35 on all debit card purchases. Terms and conditions listed above may included but not limited to any other rules or regulations implied by U Pick A Pallet LLC. Contact customer service at 618-270-4207 for any questions relating to these terms and conditions.</p>
          </div>

          <div class="row mb-4">
            <div class="col-lg-6">
              <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button> 
            </div>
          </div>
          
        </form>

        <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

      </div>
    </div>

    <div class="modal fade" id="modal_successValidation" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-body">

            <div class="card card-outline card-primary">
              <div class="card-body">
                <h2><center>Please check your email to confirm your registration.<br>Thank you!</center></h2>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_errorValidation" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-body">

            <div class="card card-outline card-danger">
              <div class="card-body">
                <h2>
                  <center>
                    Sorry, Your Email or Season Pass does not exist. 
                    <br>You can buy a Season Pass <a href="https://upickapallet.com/" target="_blank">here</a>.
                  </center>
                </h2>
                <br>
                <center>
                  <p>
                    If you think this is an error, <br>
                    please <a href="https://m.me/upickapallet1" target="_blank">contact</a> our team for assistance.
                  </p>
                </center>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

      <!-- /.content -->
   
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
     
      </div>
      <!-- Default to the left -->
      <center><strong>Copyright &copy; 2023 <a href="https://auction.upickapallet.com">U PICK A PALLET LLC</a>.</strong> All rights reserved.</center>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Sweet Alert -->
  <script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toaster -->
  <script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/toastr/toastr.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/js/adminlte.min.js"></script>

  <!-- Custom Script -->
  <script src="<?php echo base_url(); ?>/public/assets/js/pre_registration.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      PRE_REGISTRATION.loadAuctionDates();

      $('#div_seasonPass').hide();
      $('#div_guest').hide();
      $('#div_withSeasonPass').hide();
      $('#div_withOutSeasonPass').show();
      $('#txt_firstName').prop('required',true);
      $('#txt_lastName').prop('required',true);
      $('#txt_completeAddress').prop('required',true);
      $('#txt_driverLicenseNumber').prop('required',true);
      $('#txt_emailAddress').prop('required',true);
      $('#txt_seasonPassNumber').prop('required',false);
      $('#btn_submit').prop('disabled',true);

      $('#rdb1').on('change',function(){
        if($(this).is(':checked'))
        {
          $('#div_seasonPass').show();
          $('#div_withSeasonPass').show();
          $('#div_withOutSeasonPass').hide();

          $('#txt_firstName').prop('required',false);
          $('#txt_lastName').prop('required',false);
          $('#txt_completeAddress').prop('required',false);
          $('#txt_driverLicenseNumber').prop('required',false);
          $('#txt_emailAddress').prop('required',true);
          $('#txt_seasonPassNumber').prop('required',true);
        }
      });

      $('#rdb2').on('change',function(){
        if($(this).is(':checked'))
        {
          $('#div_seasonPass').hide();
          $('#div_withSeasonPass').hide();
          $('#div_withOutSeasonPass').show();

          $('#txt_firstName').prop('required',true);
          $('#txt_lastName').prop('required',true);
          $('#txt_completeAddress').prop('required',true);
          $('#txt_driverLicenseNumber').prop('required',true);
          $('#txt_emailAddress').prop('required',true);
          $('#txt_seasonPassNumber').prop('required',false);
        }
      });

      $('#chk_guests').on('change',function(){
        if($(this).is(':checked'))
        {
          $('#div_guest').show();
          $('#div_guest .row:eq(0)').find('input:eq(0)').prop('required',true);
          $('#div_guest .row:eq(0)').find('input:eq(1)').prop('required',true);
          $('#div_guest .row:eq(0)').find('input:eq(2)').prop('required',true);
          $('#div_guest .row:eq(0)').find('select').prop('required',true);
        }
        else
        {
          $('#div_guest').hide();
          $('#div_guest .row:eq(0)').find('input:eq(0)').prop('required',false);
          $('#div_guest .row:eq(0)').find('input:eq(1)').prop('required',false);
          $('#div_guest .row:eq(0)').find('input:eq(2)').prop('required',false);
          $('#div_guest .row:eq(0)').find('select').prop('required',false);
        }
      });

      $('#btn_addGuest').on('click',function(){
        let divGuestForm = `<div class="row guest-form mb-2">
                              <div class="col-lg-6">
                                <div class="row">
                                  <div class="col-lg-2">
                                    <button type="button" class="btn btn-danger btn-block" onclick="PRE_REGISTRATION.removeGuest(this)">Remove</button>
                                  </div>
                                  <div class="col-lg-5">
                                    <input type="text" class="form-control" placeholder="First Name" required>
                                  </div>
                                  <div class="col-lg-5">
                                    <input type="text" class="form-control" placeholder="Last Name" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <input type="email" class="form-control" placeholder="Email Address" required>
                                  </div>
                                  <div class="col-lg-6">
                                    <select class="form-control" required>
                                      <option value="">Relationship</option>
                                      <option value="Grand-Father">Grand Father</option>
                                      <option value="Grand-Mother">Grand Mother</option>
                                      <option value="Father">Father</option>
                                      <option value="Mother">Mother</option>
                                      <option value="Brother">Brother</option>
                                      <option value="Sister">Sister</option>
                                      <option value="Friend">Friend</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>`;
        $('#div_otherGuests').append(divGuestForm);
      });

      $('#chk_agree').on('change',function(){
        if($(this).is(':checked'))
        {
          $('#btn_submit').prop('disabled',false);
        }
        else
        {
          $('#btn_submit').prop('disabled',true);
        }
      });

      $('#form_preRegistration').on('submit',function(e){
        e.preventDefault();
        if($('#rdb1').is(':checked'))
        {
          PRE_REGISTRATION.submitWithSeasonPass(this);
        }
        else
        {
          PRE_REGISTRATION.submitWithOutSeasonPass(this);
        }
      });
    });
  </script>

</body>
</html>

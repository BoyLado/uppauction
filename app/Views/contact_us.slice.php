<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>

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

    #txt
    {
      color: white;

    }

    #inputSubject:hover,#inputEmail:hover,#inputName:hover,#inputMessage:hover {
      background-color: #f2f2f2;
    }
    #cardinline{
      display:flex;
    }
    #cardcolor{
      background-color: #6EC1E4;
    }
  </style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" id="nav">
    <div class="container">
      <a href="<?php echo base_url(); ?>" class="navbar-brand">
        <img src="<?php echo base_url(); ?>/public/assets/img/upp-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <div class="d-none d-lg-inline">
          <span class="brand-text font-weight-bold">U PICK A PALLET LLC</span>
        </div>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>/contact-us" class="nav-link text-bold">Contact Us</a>
          </li>
          @if($loggedId == true)
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>/portal/auction-dashboard" class="nav-link text-bold">
              <i class="fa fa-user fa-sm mr-1"></i> {{ $bidderName }}
            </a>
          </li>
          @else
          <li class="nav-item">
            <a href="<?php echo base_url(); ?>/login" class="nav-link text-bold">Sign In</a>
          </li>
          @endif
        </ul>
      </div>

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

        
        <!-- page content here START -->
      <center>
        <div class="mb-5">
            <h1>Feedback/Contact Us</h1> 
            
        </div>
      </center>
            <div class="row">
          <div class="col-sm-4">
           <div id="cardcolor"class="card">
              <div class="card-body">
                <center>
                <i style="font-size: 30px;"class="fa-solid fa-location-dot"></i><br>
                <center>
                <h5 class="card-title"></h5></center>
                <p class="card-text"><strong>FIND US</strong><br>315 Broadway Street, Mount Vernon, Illinois 62864, USA</p>
                <a id="txt" class="mt-2">GET IN TOUCH</a>
              </center>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <center>
                <i style="font-size: 30px;"class="fa-solid fa-phone"></i><br>
                <center>
                <h5 class="card-title"></h5></center>
                <p class="card-text"><strong>CALL US</strong><br>Feel free to give us a call anytime. Our customer service hotline is open 24/7.</p>
                <a class="mt-2">+1 618-270-4207</a>
              </center>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div id="cardcolor"class="card">
              <div class="card-body">
                <center>
                <i style="font-size: 30px;"class="fa-solid fa-envelope"></i><br>
                <center>
                <h5 class="card-title"></h5></center>
                <p class="card-text"><strong>EMAIL US</strong><br>Send us an email at any time and we will get back to you within 24 hours</p>
                <a id="txt"class="mt-2">customerservice@upickapallet.com</a>
              </center>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="card">
            <div class="card-body row">
              
              <div class="col-5 text-center d-flex align-items-center justify-content-center">
                <div class="">
                  <i style="font-size: 150px;" class="fa-solid fa-envelope-open-text mb-2"></i>
                  <p class="lead mb-5">If you have questions or <br> just want to get in touch, use the form below.<br> We look forward to hearing from you!<br>
                  </p>
                </div>
              </div>
                  
              <div class="col-7">
                <form id="form_contactUs" method="post">
                  <div class="form-group">
                    <label for="txt_name">Name *</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" required>
                  </div>
                  <div class="form-group">
                    <label for="txt_email">E-Mail *</label>
                    <input type="email" class="form-control" id="txt_email" name="txt_email" required>
                  </div>
                  <div class="form-group">
                    <label for="txt_subject">Subject *</label>
                    <input type="text" class="form-control" id="txt_subject" name="txt_subject" required>
                  </div>
                  <div class="form-group">
                    <label for="txt_message">Message *</label>
                    <textarea class="form-control" rows="4" id="txt_message" name="txt_message" required></textarea>
                  </div>
                  <div class="g-recaptcha mb-2" data-sitekey="{{ $googleSiteKey }}" data-callback="form_contactUs"></div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btn_sendMessage" disabled>
                      <i class="fa fa-paper-plane mr-2"></i> Send Message
                    </button>
                  </div>
                </form>
              </div>
                
            </div>
          </div>
        </section>

          <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="510" id="gmap_canvas" src="https://maps.google.com/maps?q=315 Broadway Street, Mount Vernon, Illinois 62864, USA&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://2yu.co">2yu</a><br><style>.mapouter{position:relative;text-align:right;height:510px;width:100%;}</style><a href="https://embedgooglemap.2yu.co">html embed google map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:510px;width:100%;}</style></div></div>
  
        <!-- page content here END -->


        <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

      </div>
    </div>

    <div class="modal fade" id="modal_successValidation" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
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
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="card card-outline card-danger">
              <div class="card-body">
                <h2>
                  <center>
                    <span id="lbl_errorMsg">Sorry, Your Email or Season Pass does not exist. </span>
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

  <script src="https://www.google.com/recaptcha/api.js"></script>

  <!-- Custom Script -->
  <script src="<?php echo base_url(); ?>/public/assets/js/contact_us.js"></script>

  <script type="text/javascript">
    function form_contactUs()
    {
      $('#btn_sendMessage').prop('disabled',false);
    }

    $(document).ready(function(){
      $('#form_contactUs').on('submit',function(e){
        e.preventDefault();
        CONTACT_US.sendEmail(this);
      });
    });
  </script>

</body>
</html>

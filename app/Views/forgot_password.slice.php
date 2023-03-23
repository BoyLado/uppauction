<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $pageTitle }}</title>

  <!-- Icon -->
  <link rel="icon" href="<?php echo base_url(); ?>/public/assets/img/arkonorllc-logo-edited.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Sweet alert -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toaster -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/css/adminlte.min.css">
  
    <style type="text/css">
    body{
      background-image: url('<?php echo base_url(); ?>/public/assets/img/bg6.gif');
      background-size: cover;
      background-position: center; /* Center the image */
      background-repeat: no-repeat; /* Do not repeat the image */
    }
    #signbutton{

  border-color: white;
  color: white;
  background-color: #22859F;
}
#signbutton{

  border-color: white;
  color: white;
}


  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="<?php echo base_url(); ?>">U PICK A PALLET<b>LLC</b> </a> -->
  </div>
  <!-- /.login-logo -->
  <div  class="card">
    <div id="signbutton" class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form id="form_forgotPassword">
        <div class="input-group mb-3">
          <input type="email" class="form-control form-control-sm" id="txt_bidderEmail" name="txt_bidderEmail" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span style="color: white;"class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" id="btn_forgotPassword" class="btn btn-primary btn-sm btn-block">Request new password</button>
            <a href="<?php echo base_url(); ?>/login" class="btn btn-default btn-sm btn-block">Log in</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <input type="hidden" id="txt_baseUrl" value="<?php echo base_url(); ?>">

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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
<script src="<?php echo base_url(); ?>/public/assets/js/index.js"></script>
<!-- Events -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#form_forgotPassword').on('submit',function(e){
      e.preventDefault();
      INDEX.forgotPassword(this);
    });
  });
</script>

</body>
</html>


<div class="row"> 
  <div class="col-12">
    <!-- blank -->
  </div>
</div>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

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
 
    #email_confirmation{
      background-color: lightblue;
      margin-top: 2%;

    }
      #email_confirmation1{
      background-color: #Be3525;
      margin-top: 2%;

    }
    #img{
    	height: 104px;
  		width: 104px;
    }
    #notcompleted{

    	color: white;
    }   
  </style>
</head>
<body>

	@if($confirmation_result == 'Success')
		<center>
			<div id="email_confirmation" class="card" style="width: 50rem;">
				 <i id="email_confirmation" class="fa-solid fa-envelope-open-text fa-5x"></i>
				 <div class="card-body">
				 	<hr>
				    <p class="card-text"><h1>Email confirmation completed!</h1></p>		
				</div>
			</div>
		</center>
	@else
		<center>
			<div id="email_confirmation1" class="card" style="width: 50rem;">
				 <i id="email_confirmation1" class="fa-solid fa-circle-xmark fa-5x"></i>
				 <div class="card-body">
				 	<hr>
				    <p class="card-text"><h1 id="notcompleted">Pre Registration cannot be completed!</h1></p>
				</div>
			</div>
		</center>
	@endif

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


</body>
</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Top Navigation</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style type="text/css">
    


#button {
  margin-top: 25px;
  margin-bottom: 25px;
}

#text{
  margin-top: 25px;
}

#fields{
  margin-bottom: 25px;

}

#text1{
  margin-top: 25px;
}
#h2, #h4{
  margin-top: 25px;
  text-align: center;
}

#nav{

    background-color: #6EC1E4;

}
#icon{

  color: white;
}

  </style>

</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white" id="nav">
    <div class="container">
      <a href="<?php echo base_url(); ?>/public/assets/AdminLTE/index3.html" class="navbar-brand">
        <img src="<?php echo base_url(); ?>/public/assets/img/upp-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>U PICK A PALLET LLC</b></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li>
          <a class="nav-link" href="#">
            <i class="btn btn-lg fa-brands fa-instagram"></i></a>
          </a>
        </li>
        <li>
          <a class="nav-link" href="#">
            <i class="btn btn-lg fa-brands fa-square-facebook"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">
            <i class="btn btn-lg fa-brands fa-square-twitter"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="#">
            <i class="btn btn-lg fa-brands fa-square-youtube"></i>
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
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div>
          <h2 id="h2">
            Auction Pre-Registration
          </h2>
          <div>
          <h5 id="h4">
            To pre-register to bid onsite at our next auction, please fill out the form below. After we receive your information, we will contact you to complete the registration process.
          </h5>
        </div>
        <div class="row">
          <div class="col-md-3">
                <h3  class="card-title"><b>Auction Date</b></h3>
                  <div id="text1" class="input-group date" id="reservationdatetime" data-target-input="nearest">
                    <input type="date" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                      <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                      
                    </div>
                  </div>
          </div>
        </div>

              <div class="row">
                <div class="col-lg-6">
                  <label id="text"for="formGroupExampleInput2">Company Name (Optional)</label>
                  <input id="fields" type="text" class="form-control" id="formGroupExampleInput" placeholder="Company Name">
                </div>
               </div>

              <div class="row">
                <div class="col-lg-6">
                  <label for="formGroupExampleInput2">First</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="First name">
                </div>
                <div class="col-lg-6">
                  <label for="formGroupExampleInput2">Last</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Last name">
                </div>
              </div>
              <form>
                <div class="form-group">
                  <label id="text"for="exampleFormControlInput1">Street Address</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Street Address">
                </div>
              </form>
              <form>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Address Line</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Address Line">
                </div>
              </form>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">City</label>
                  <input type="text" class="form-control" id="inputCity" placeholder="City">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">State</label>
                  <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>Alabama</option>
                    <option>Alaska</option>
                    <option>Arizona</option>
                    <option>Arkansas</option>
                    <option>California</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">ZIP Code</label>
                  <input type="text" class="form-control" id="inputZip" placeholder="inputZip">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label for="formGroupExampleInput2">Phone Number</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Phone Number">
                </div>
                <div class="col-lg-6">
                  <label for="formGroupExampleInput2">Driver’s License Number</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Driver’s License Number">
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label id="text"for="formGroupExampleInput2">Email Address</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Email Address">
                </div>
               </div>
               <label id="text" lass="gfield_label gform-field-label gfield_label_before_complex">I AGREE TO THE BUYERS CONTRACT<span class="gfield_required"><span class="gfield_required gfield_required_asterisk"> *</span></span></label>
               <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    <h4>BY CONSENTING AND BIDDING YOU ARE ACKNOWLEDGING AGREEMENT WITH THE TERMS BELOW.</h4>
                  </label>
               </div>
               <div style="height: 40vh; overflow-y:scroll; width: 100%; border: 1px solid black;">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos 
                sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                recusandae alias error harum maxime adipisci amet laborum. Perspiciatis 
                minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit 
                quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur 
                fugiat, temporibus enim commodi iusto libero magni deleniti quod quam 
                consequuntur! Commodi minima excepturi repudiandae velit hic maxime
                doloremque. Quaerat provident commodi consectetur veniam similique ad 
                earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo 
                fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore 
                suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium
                modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam 
                totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam 
                quasi aliquam eligendi, placeat qui corporis!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,
                quia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos 
                sapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam
                recusandae alias error harum maxime adipisci amet laborum. Perspiciatis 
                minima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit 
                quibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur 
                fugiat, temporibus enim commodi iusto libero magni deleniti quod quam 
                consequuntur! Commodi minima excepturi repudiandae velit hic maxime
                doloremque. Quaerat provident commodi consectetur veniam similique ad 
                earum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo 
                fugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore 
                suscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium
                modi minima sunt esse temporibus sint culpa, recusandae aliquam numquam 
                totam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam 
                quasi aliquam eligendi, placeat qui corporis!
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label id="text"for="formGroupExampleInput2">Type Name To Agree To Terms</label>
                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Full Name">
                </div>
               </div>
               <div >
               <button id="button" type="button" class="btn btn-primary">Submit</button>
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
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>

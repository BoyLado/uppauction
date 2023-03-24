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
          <!-- <div class="mt-1 float-left">
            <input type="search" class="form-control form-control-sm" id="txt_searchWinner" name="txt_searchWinner" placeholder="Search Winner">
          </div>
          <div class="mt-1 float-right">
            <input type="date" class="form-control form-control-sm" id="txt_dateFilter" name="txt_dateFilter" value="<?php echo date('Y-m-d'); ?>">
          </div> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <!-- Start UI Content -->

      <div class="card">
        <div class="card-header"><b>Payment Histories</b></div>
        <div class="card-body">
          <table class="table table-bordered" id="tbl_payments">
            <thead>
              <tr>
                <th>Transaction Date</th>
                <th>Bidder Name</th>
                <th>Sub Total</th>
                <th>Tax (9.54%)</th>
                <th>Transaction Fee (4.35%)</th>
                <th>Cash Payment</th>
                <th>Card Payment</th>
                <th>Total Payment</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>

      <div class="modal fade" id="modal_paymentDetails" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title">
                <i class="fa fa-shopping-cart mr-1"></i> <span id="lbl_bidderNameHeader">Juan Dela Cruz</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="font-family: Arial, sans-serif;">

              <center>
                <img src="<?php echo base_url(); ?>/public/assets/img/payment_receipt.jpeg" width="300px" alt="AdminLTE Logo">
              </center>
              
              <hr>

              <center>
                <div>
                  <p>Hello <b>Bidder Number <span id="lbl_bidderNumber"></span></b>,</p>
                  <p>
                    Congratulations! You have won (<span id="lbl_numberOfItems"></span>) items from the auction today.
                  </p>

                  <br>
                  
                  <p><b>Receipt #<span id="lbl_receiptNumber"></span></b></p>
                  <p><span id="lbl_dateSent"></span></p>

                  <br>

                  <p>Customer</p>
                  <p><b><span id="lbl_bidderName"></span></b></p>
                  <a href="javascript:void(0)"><span id="lbl_bidderEmailAddress"></span></a>
                  <p><span id="lbl_bidderPhoneNumber"></span></p>
                  <p><span id="lbl_bidderAddress"></span></p>
                </div>

                <br>

                <h4>PAYMENT SUMMARY</h4>

                <table style="width:50%" id="tbl_items">
                  <tbody>
                    
                  </tbody>
                </table>
                <table style="width:50%">
                  <tr>
                    <td style="width: 50%;"><b>Subtotal:</b></td>
                    <td><span style="float:right;"><b>$ <span id="lbl_subTotal"></span></b></span></td>
                  </tr>
                  <tr>  
                    <td style="width: 50%;">Sales tax:</td>
                    <td><span style="float:right;">$ <span id="lbl_tax"></span></span></td>
                  </tr>
                  <tr>
                    <td style="border-bottom: 1px dotted black; width: 50%;">Transaction Fee:</td>
                    <td style="border-bottom: 1px dotted black;">
                      <span style="float:right;">$ <span id="lbl_cardTransactionFee"></span></span>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 50%;"><b>Total:</b></td>
                    <td><span style="float:right;"><b>$ <span id="lbl_total"></span></b></span></td>
                  </tr>
                </table>
              </center>

              <hr>

              <center>
                <p><b>Thank you for being a great customer!</b></p>
                <p>U Pick A Pallet LLC</p>
                <p>323 Broadway Street</p>
                <p>Mount Vernon, IL 62864-5115 United States</p>
                <a href="mailto:customerservice@upickapallet.com">customerservice@upickapallet.com</a>
                <p>(618) 270 - 4207</p>
              </center>   

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
    $('#nav_payments').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-dollar mr-2"></i>
                  <b>AUCTION PAYMENTS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();


    PAYMENTS.loadPayments();

  });
</script>

@endsection

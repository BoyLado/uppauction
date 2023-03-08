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
            <input type="date" class="form-control form-control-sm" id="txt_dateFilter" name="txt_dateFilter" value="<?php echo date('Y-m-d'); ?>">
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
        <div class="row" id="div_winners">

        </div>
      </div>

      <div class="modal fade" id="modal_checkout" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title">
                <i class="fa fa-shopping-cart mr-1"></i> <span id="lbl_bidderName">Juan Dela Cruz</span>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_checkout">
                <input type="hidden" id="txt_bidderId" name="txt_bidderId">
                <table class="table table-striped mb-2" id="tbl_cart">
                  <thead class="bg-primary">
                    <tr>
                      <th>No.</th>
                      <th>Item No.</th>
                      <th>Item Description</th>
                      <th><span class="float-right">Amount</span></th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                  <tfoot class="bg-secondary">
                    <tr>
                      <td colspan="4"></td>
                    </tr>
                  </tfoot>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-6 col-lg-6">
                    <table class="table mb-0">
                      <tbody>
                        <tr>
                          <td width="58%"><label>Sub Total: </label></td>
                          <td><label class="float-right">$<span id="lbl_subTotal">0.00</span></label></td>
                        </tr>
                        <tr>
                          <td width="58%"><label>Tax (9.54%): </label></td>
                          <td><label class="float-right">$<span id="lbl_tax">0.00</span></label></td>
                        </tr>
                        <tr>
                          <td width="58%"><label>Card Transaction Fee (4.35%): </label></td>
                          <td><label class="float-right">$<span id="lbl_cardTransactionFee">0.00</span></label></td>
                        </tr>
                        <tr>
                          <td width="58%"><label>Total: </label></td>
                          <td><label class="float-right text-danger">$<span id="lbl_total">0.00</span></label></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="col-sm-12 col-md-6 col-lg-6 ">
                    <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chk_cashPayment" checked>
                          <label class="form-check-label text-bold" for="chk_cashPayment">CASH</label>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" class="form-control" id="txt_cashPayment" name="txt_cashPayment">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="chk_cardPayment">
                          <label class="form-check-label text-bold" for="chk_cardPayment">CARD</label>
                        </div>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" class="form-control" id="txt_cardPayment" name="txt_cardPayment" readonly>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="callout callout-danger bg-warning">
                        <h5 class="text-bold">Change: </h5>
                        <h3 class="text-bold">$<span id="lbl_change">0.00</span></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </form>     

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" id="btn_checkout" form="form_checkout">
                <i class="fa fa-shopping-cart mr-1"></i> Check Out
              </button>
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

<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/moment/moment-timezone-with-data.js"></script>
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fullcalendar/fullcalendar.js"></script>


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

    function numberWithCommas(x) {
       return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function computePaymentAndChange()
    {
      let change = 0;
      let cashPayment = ($('#txt_cashPayment').val() == "")? 0 : $('#txt_cashPayment').val();
      let cardPayment = ($('#txt_cardPayment').val() == "")? 0 : $('#txt_cardPayment').val();

      let transactionFee = 0;

      transactionFee = (cardPayment == "")? 0 : (parseFloat(cardPayment) * 0.0435);
      $('#lbl_cardTransactionFee').text(numberWithCommas(parseFloat(transactionFee).toFixed(2)));

      let subTotal = parseFloat($('#lbl_subTotal').text());
      let tax = parseFloat($('#lbl_tax').text());
      let totalAmount = 0;
      if($('#chk_cardPayment').is(':checked'))
      {
        totalAmount = subTotal + tax + transactionFee;
        console.log(totalAmount);
        $('#lbl_total').text(numberWithCommas(totalAmount.toFixed(2)));
      }
      else
      {
        totalAmount = subTotal + tax;
        console.log(totalAmount);
        $('#lbl_total').text(numberWithCommas(totalAmount.toFixed(2)));
      }

      let total = $('#lbl_total').text();

      change = (parseFloat(cashPayment) + parseFloat(cardPayment)) - parseFloat(total);
      if(change >= 0)
      {
        $('#lbl_change').text(numberWithCommas(change.toFixed(2)));
      }
      else
      {
        $('#lbl_change').text(numberWithCommas((0).toFixed(2)));
      }
    }

    //
    // ======================================================>
    //

    WINNERS.loadWinners();
    
    $('#txt_searchWinner').on('keyup',function(){
      WINNERS.loadWinners($(this).val());
    });

    $('#txt_dateFilter').on('change',function(){
      WINNERS.loadWinners($('#txt_searchWinner').val());
    });

    $('#chk_cashPayment').on('change',function(){
      if($(this).is(':checked'))
      {
        $('#txt_cashPayment').prop('readonly',false);
        $('#txt_cashPayment').prop('required',true);
        $('#txt_cashPayment').focus();
        $('#btn_checkout').prop('disabled',false);
      }
      else
      {
        $('#txt_cashPayment').prop('readonly',true);
        $('#txt_cashPayment').val('');
        $('#txt_cardPayment').focus();
      }
      let cashPayment = $(this).is(':checked');
      let cardPayment = $('#chk_cardPayment').is(':checked');
      if(cashPayment == false && cardPayment == false)
      {
        $('#btn_checkout').prop('disabled',true);
      }
      computePaymentAndChange();
    });

    $('#chk_cardPayment').on('change',function(){
      if($(this).is(':checked'))
      {
        $('#txt_cardPayment').prop('readonly',false);
        $('#txt_cardPayment').prop('required',true);
        $('#txt_cardPayment').focus();
        $('#btn_checkout').prop('disabled',false);
      }
      else
      {
        $('#txt_cardPayment').prop('readonly',true);
        $('#txt_cardPayment').val('');
        $('#txt_cashPayment').focus();
      }
      let cashPayment = $('#chk_cashPayment').is(':checked');
      let cardPayment = $(this).is(':checked');
      if(cashPayment == false && cardPayment == false)
      {
        $('#btn_checkout').prop('disabled',true);
      }
      computePaymentAndChange();
    });

    $('#txt_cashPayment').on('keyup',function(){
      computePaymentAndChange();
    });

    $('#txt_cardPayment').on('keyup',function(){
      computePaymentAndChange();
    });

    $('#form_checkout').on('submit',function(e){
      e.preventDefault();
      WINNERS.addPayment(this);
    });

  });
</script>

@endsection

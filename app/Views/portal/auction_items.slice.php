@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')
<!-- Square Payment -->
<link href="<?php echo base_url(); ?>/public/assets/css/square-app.css" rel="stylesheet" />

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

  .zoom { 
    transition: all .2s ease-in-out; 
  }

  .zoom:hover { 

    transform: scale(1.1);
    z-index: 9;
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
  <!-- <div class="content-header pt-1 pb-1">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h6 class="mt-1 float-left">
            <span>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">Contacts</a> -
            </span> 
            <small>
              <a href="<?php echo base_url(); ?>/contacts" class="text-muted">All</a>
            </small>
          </h6>
          <div class="float-right">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_addContacts">
                  <i class="fa fa-plus mr-1"></i>Add Contact
                </a>
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_importContacts">
                  <i class="fa fa-upload mr-1"></i>Import
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_addContacts">
                <i class="fa fa-plus mr-1"></i> Add Contact
              </button>
              <button type="button" class="btn btn-default btn-sm" id="btn_importContacts">
                <i class="fa fa-upload mr-1"></i> Import
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- /.content-header -->

  <br>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <!-- Start UI Content -->

      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4">
          <h5>Payment Form</h5>
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label>First Name *</label>
                <input type="text" class="form-control mt-0" id="inputEmail3" placeholder="First Name *">
              </div>
              <div class="form-group">
                <label>Last Name *</label>
                <input type="text" class="form-control mt-0" id="inputEmail3" placeholder="Last Name *">
              </div>
              <div class="form-group">
                <label>Email Address*</label>
                <input type="email" class="form-control mt-0" id="inputEmail3" placeholder="Email Address *">
              </div>
              <form id="form_payment">
                <div id="card-container"></div>
                <input type="hidden" id="txt_amount">
                <button id="card-button" type="button">Pay $0.00</button>
              </form> 
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-8">
          <h5>Auction Winning Items</h5>
          <div class="hide-scroll" style="width:100%; height: 100vh; overflow:scroll; scroll-behavior: hidden;">
            <div class="row" id="div_items">
              <!-- <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Item #1</h3>
                    <div class="float-right">
                      <a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="nav-icon fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu" style="">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="ITEMS.selectItem();">
                          <i class="fa fa-pen mr-1"></i>Edit
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="ITEMS.removeItem();">
                          <i class="fa fa-trash mr-1"></i>Delete
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <h5>WINNER: <span class="text-primary text-bold">Juan Dela Cruz</span></h5>
                    <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$4,500</span></h5>
                    <h5>ITEM DESCRIPTION:</h5>
                    <h6 class="text-muted" id="lbl_description">Hello World</h6>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Item #2</h3>
                  </div>
                  <div class="card-body">
                    <h5>WINNER: <span class="text-primary text-bold">Juan Dela Cruz</span></h5>
                    <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$4,500</span></h5>
                    <h5>ITEM DESCRIPTION:</h5>
                    <h6 class="text-muted" id="lbl_description">Hello World</h6>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Item #3</h3>
                  </div>
                  <div class="card-body">
                    <h5>WINNER: <span class="text-primary text-bold">Juan Dela Cruz</span></h5>
                    <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$4,500</span></h5>
                    <h5>ITEM DESCRIPTION:</h5>
                    <h6 class="text-muted" id="lbl_description">Hello World</h6>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="card card-outline card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Item #4</h3>
                  </div>
                  <div class="card-body">
                    <h5>WINNER: <span class="text-primary text-bold">Juan Dela Cruz</span></h5>
                    <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$4,500</span></h5>
                    <h5>ITEM DESCRIPTION:</h5>
                    <h6 class="text-muted" id="lbl_description">Hello World</h6>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_editItem" role="dialog">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title"><i class="fa fa-pen mr-1"></i> Edit Item</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_editItem">
                <input type="hidden" id="txt_itemId" name="txt_itemId">
                <table class="table mb-0">
                  <tbody>
                    <tr>
                      <td class="p-1">
                        <label>Item Number *:</label>
                        <input type="text" class="form-control" id="txt_editItemNumber" name="txt_editItemNumber" required>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-1">
                        <label>Item Description *:</label>
                        <textarea class="form-control" rows="5" id="txt_editItemDescription" name="txt_editItemDescription" required></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-1">
                        <label>Bidder Number/Name *:</label>
                        <select class="form-control select2" id="slc_editBidderNumber" name="slc_editBidderNumber" style="width: 100%;" required>
                          <option value="">Choose Bidder</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-1">
                        <label>Amount *:</label>
                        <input type="number" class="form-control" id="txt_editWinningAmount" name="txt_editWinningAmount" required>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>             

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" id="btn_submitEditItem" form="form_editItem">
                <i class="fa fa-save mr-2"></i> Save Changes
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

<!-- square payment -->
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/select2/js/select2.full.min.js"></script>

<!-- Custom Scripts -->
<script type="text/javascript" src="<?php echo base_url(); ?>/public/assets/js/portal/{{ $customScripts }}.js"></script>

<script type="text/javascript">

  const appId = 'sandbox-sq0idb-os8hvBheMABtzl3HhNLdXA';
  const locationId = 'L9K4W3J739S2N';

  async function initializeCard(payments) {
    const card = await payments.card();
    await card.attach('#card-container');

    return card;
  }

  // async function createPayment(token) {
  //   const body = JSON.stringify({
  //     locationId,
  //     sourceId: token,
  //   });

  //   const paymentResponse = await fetch('/payment', {
  //     method: 'POST',
  //     headers: {
  //       'Content-Type': 'application/json',
  //     },
  //     body,
  //   });

  //   if (paymentResponse.ok) {
  //     return paymentResponse.json();
  //   }

  //   const errorBody = await paymentResponse.text();
  //   throw new Error(errorBody);
  // }

  async function tokenize(paymentMethod) 
  {
    const tokenResult = await paymentMethod.tokenize();
    if (tokenResult.status === 'OK') 
    {
      return tokenResult.token;
    } 
    else 
    {
      let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
      if (tokenResult.errors) 
      {
        errorMessage += ` and errors: ${JSON.stringify(
          tokenResult.errors
        )}`;
      }
      throw new Error(errorMessage);
    }
  }

  // status is either SUCCESS or FAILURE;
  function displayPaymentResults(status) 
  {
    const statusContainer = document.getElementById('payment-status-container');
    if (status === 'SUCCESS') 
    {
      statusContainer.classList.remove('is-failure');
      statusContainer.classList.add('is-success');
    } 
    else 
    {
      statusContainer.classList.remove('is-success');
      statusContainer.classList.add('is-failure');
    }

    statusContainer.style.visibility = 'visible';
  }

  $(document).ready(async function(){
    if (!window.Square) 
    {
      throw new Error('Square.js failed to load properly');
    }

    let payments;
    try 
    {
      payments = window.Square.payments(appId, locationId);
    } 
    catch 
    {
      const statusContainer = document.getElementById('payment-status-container');
      statusContainer.className = 'missing-credentials';
      statusContainer.style.visibility = 'visible';
      return;
    }

    let card;
    try 
    {
      card = await initializeCard(payments);
    } 
    catch (e) 
    {
      alert('Initializing Card failed', e);
      return;
    }

    // Checkpoint 2.
    async function handlePaymentMethodSubmission(event, paymentMethod) 
    {
      event.preventDefault();

      if($('#txt_amount').val() == 0)
      {
        alert('Zero');
      }
      else
      {
        try 
        {
          // disable the submit button as we await tokenization and make a payment request.
          cardButton.disabled = true;
          const token = await tokenize(paymentMethod);
          ITEMS.createPayment(token);
        }
        catch (e) 
        {
          cardButton.disabled = false;
          alert(e.message);
        }
      }
    }

    const cardButton = document.getElementById('card-button');
    cardButton.addEventListener('click', async function (event) {
      await handlePaymentMethodSubmission(event, card);
    });
  });

  $(document).ready(function(){
    //jQuery Events

    //sideNav active/inactive

    $('.nav-item').removeClass('menu-open');
    $('.nav-link').removeClass('active');
    $('#nav_items').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-list mr-2"></i>
                  <b>AUCTION ITEMS</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //


    ITEMS.loadWinningItems();
    ITEMS.loadBidders('slc_bidderNumber');

    $('#txt_itemNumber').focus();

    $('#form_addItem').on('submit',function(e){
      e.preventDefault();
      ITEMS.addItem(this);
    });

    $('#form_editItem').on('submit',function(e){
      e.preventDefault();
      ITEMS.editItem(this);
    });


  });
</script>

@endsection

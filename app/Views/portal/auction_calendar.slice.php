@extends('template.layout')

@section('page_title',$pageTitle)



@section('custom_styles')
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/select2/css/select2.min.css">
<!-- Full Calendar -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/AdminLTE/plugins/fullcalendar/fullcalendar.css">

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
            <!-- <input type="search" class="form-control form-control-sm" id="txt_searchBidder" name="txt_searchBidder" placeholder="Search Bidder"> -->
            <h5>Auction Events</h5>
          </div>
          
          <div class="mt-1 float-right">
            <div class="d-inline d-lg-none">
              <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown">
                <i class="nav-icon fas fa-ellipsis-v"></i>
              </button>
              <div class="dropdown-menu" style="">
                <a class="dropdown-item" href="javascript:void(0)" id="lnk_preRegistration">
                  <i class="fa fa-plus mr-1"></i>Pre Registration
                </a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <button type="button" class="btn btn-default btn-sm" id="btn_preRegistration">
                <i class="fa fa-plus mr-1"></i> Pre Registration
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
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div id="div_calendars"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="modal_preRegistration" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header modal-header--sticky">
              <h5 class="modal-title" id="lbl_header"><i class="fa fa-plus mr-1"></i> Pre Registration</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form id="form_preRegistration">
                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4 col-sm-12">
                      <label>Auction Date</label>
                      <select class="form-control" id="slc_auctionDate" name="slc_auctionDate" required>
                        
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="chk_guests" name="chk_guests" value="guests">
                    <label class="form-check-label" for="chk_guests">
                      <b>I want to invite guests.</b>
                    </label>
                  </div>
                  <div id="div_guest">
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

                <div class="mb-3 p-2" style="height: 35vh; overflow-y:scroll; width: 100%; border: 1px solid black;">
                  <center><h5>Auction Terms and conditions</h5></center>
                  <p style="text-align: justify;">All items sold in U Pick A Pallet auctions are sold “as is” and we do not accept refunds or exchanges on any auction items. It is your responsibility to fullfill your purchase obligation before exiting the auction. U Pick A Pallet will not be held responsible for any accidents that may occur physical or emotional. All attendees are required to be present with a season pass holder. I consent to U Pick A Pallet season pass holder terms and conditions as well as the terms and conditions applied to  U Pick A Pallet LLC. I understand that all items are sold “as is” and I will not attempt to perform any form of chargeback from the use of debit or credit card. I understand and consent to the fee of 4.35 on all debit card purchases. Terms and conditions listed above may included but not limited to any other rules or regulations implied by U Pick A Pallet LLC. Contact customer service at 618-270-4207 for any questions relating to these terms and conditions.</p>
                </div>
              </form>

            </div>
            <div class="modal-footer modal-footer--sticky">
              <button type="submit" class="btn btn-primary" id="btn_submitForm" form="form_preRegistration">Submit</button>
            </div>
          </div>
        </div>
      </div>

      <br>

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

<!-- FullCallendar -->
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
    $('#nav_calendar').addClass('active');

    //topNav icon & label

    let topNav = `<i class="fas fa-calendar mr-2"></i>
                  <b>CALENDAR</b>`;
    $('#lnk_topNav').html(topNav);

    //events
    $('.select2').select2();

    //
    // ======================================================>
    //

    $('#div_guest').hide();
    $('#btn_submitForm').prop('disabled',true);
    CALENDAR.loadAuctions();

    $('#lnk_preRegistration').on('click',function(){
      CALENDAR.selectAuctionDates();
      $('#modal_preRegistration').modal('show');
    });

    $('#btn_preRegistration').on('click',function(){
      CALENDAR.selectAuctionDates();
      $('#modal_preRegistration').modal('show');
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
                                  <button type="button" class="btn btn-danger btn-block" onclick="CALENDAR.removeGuest(this)">Remove</button>
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
        $('#btn_submitForm').prop('disabled',false);
      }
      else
      {
        $('#btn_submitForm').prop('disabled',true);
      }
    });

    $('#form_preRegistration').on('submit',function(e){
      e.preventDefault();
      if(confirm('Please Confirm!'))
      {
        CALENDAR.submitPreRegistration(this);
      }      
    });

  });
</script>

@endsection

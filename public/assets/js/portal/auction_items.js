const ITEMS = (function(){

	let thisItems = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisItems.loadWinningItems = function()
	{
		$('body').waitMe(_waitMeLoaderConfig);
		$.ajax({
			/* ItemController->loadWinningItems() */
		  url : `${baseUrl}/portal/load-winning-items`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	$('#txt_firstName').val(data['arrBidderDetails']['first_name']);
		  	$('#txt_lastName').val(data['arrBidderDetails']['last_name']);
		  	$('#txt_emailAddress').val(data['arrBidderDetails']['email']);

		  	let items = '';
		  	let count = 0;
		  	let tax = 0;
		  	let transactionFee = 0;
		  	let subTotal = 0;
		  	let totalAmount = 0;
		  	data['arrItemDetails'].forEach(function(value,key){
		  		items += `<div class="col-sm-12 col-md-6 col-lg-6">
				              <div class="card card-outline card-primary">
				                <div class="card-header">
				                  <h3 class="card-title">Item #${value['item_number']}</h3>
				                  <div class="float-right">
				                    ${(value['paid'] == 1)? 'PAID' : '<span class="text-red">UNPAID</span>'}
				                  </div>
				                </div>
				                <div class="card-body">
				                  <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$${value['winning_amount']}</span></h5>
				                  <h5>ITEM DESCRIPTION:</h5>
				                  <h6 class="text-muted" id="lbl_description">${value['item_description']}</h6>
				                </div>
				              </div>
				            </div>`;
				  count++;
				  subTotal += parseFloat(value['winning_amount']);
		  	});

		  	if(count == 0)
		  	{
		  		items = `<div class="col-sm-12 col-md-12 col-lg-12">
		  							<center>
		  								<h5 class="text-muted">No Item/s Found!</h5>
	  								</center>
	  							</div>`;
		  	}

		  	$('#div_items').html(items);

		  	tax = subTotal * 0.0954;
		  	transactionFee = (subTotal + tax) * 0.0435;
		  	totalAmount = subTotal + tax + transactionFee;  

		  	$('#txt_amount').val(totalAmount.toFixed(2));
		  	$('#card-button').html(`Pay $${totalAmount.toFixed(2)}`);

		  	$('body').waitMe('hide');
		  }
		});
	}

	thisItems.createPayment = function(cardToken)
	{
		let formData = new FormData();

		formData.set('cardToken',cardToken);
		formData.set('txt_emailAddress',$('#txt_emailAddress').val());
		formData.set('txt_firstName',$('#txt_firstName').val());
		formData.set('txt_lastName',$('#txt_lastName').val());

		$('body').waitMe(_waitMeLoaderConfig);
		
		$.ajax({
			/* PaymentController->createPayment() */
		  url : `${baseUrl}/portal/load-create-payment`,
		  method : 'post',
		  dataType: 'json',
		  processData: false, // important
		  contentType: false, // important
		  data : formData,
		  success : function(result)
		  {
		  	console.log(result);
		  	$('body').waitMe('hide');

        Toast.fire({
	        icon: 'success',
	        title: 'Success! <br>Payment Sent.',
	      });
		  	setTimeout(function(){
          window.location.replace(`${baseUrl}/portal/auction-items`);
        }, 2000);
		  }
		});
	}

	return thisItems;

})();
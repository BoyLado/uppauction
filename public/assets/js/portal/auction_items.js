const ITEMS = (function(){

	let thisItems = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisItems.loadBidders = function(slcId, bidderId = "")
	{
		$.ajax({
			/* BidderController->loadBidders() */
		  url : `${baseUrl}/portal/load-bidders`,
		  method : 'get',
		  dataType: 'json',
		  data:{order:'ASC', textSearch : ''},
		  success : function(data)
		  {
		  	let options = '<option value="">Choose Bidder</option>';

		  	data.forEach(function(value,key){
		  		if(bidderId == value['id'])
		  		{
		  			options += `<option value="${value['id']}" selected>${value['bidder_number']} - ${value['first_name']} ${value['last_name']}</option>`;
		  		}
		  		else
		  		{
		  			options += `<option value="${value['id']}">${value['bidder_number']} - ${value['first_name']} ${value['last_name']}</option>`;
		  		}
		  	});

		  	$(`#${slcId}`).html(options).select2();
		  }
		});
	}

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
		  	let items = '';
		  	let count = 0;
		  	let totalAmount = 0;
		  	data.forEach(function(value,key){
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
				  totalAmount += parseFloat(value['winning_amount']);
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

		  	$('#txt_amount').val(totalAmount);
		  	$('#card-button').html(`Pay $${(totalAmount).toFixed(2)}`);

		  	$('body').waitMe('hide');
		  }
		});
	}

	thisItems.createPayment = function(cardToken)
	{
		let formData = new FormData();

		formData.set('cardToken',cardToken);

		$('body').waitMe(_waitMeLoaderConfig);
		
		$.ajax({
			/* ItemController->createPayment() */
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

	thisItems.addItem = function(thisForm)
	{
		let formData = new FormData(thisForm);

		$.ajax({
			/* ItemController->addItem() */
		  url : `${baseUrl}/portal/add-item`,
		  method : 'post',
		  dataType: 'json',
		  processData: false, // important
		  contentType: false, // important
		  data : formData,
		  success : function(result)
		  {
		    console.log(result);
		    if(result == 'Success')
		    {
          Toast.fire({
		        icon: 'success',
		        title: 'Success! <br>New item saved successfully.',
		      });
          ITEMS.loadItems();
          ITEMS.loadBidders('slc_bidderNumber');

          $('#txt_itemNumber').val('').focus();
          $('#txt_itemDescription').val('');
          $('#txt_winningAmount').val('');
		    }
		    else
		    {
          Toast.fire({
		        icon: 'error',
		        title: `Error! <br>${result}`
		      });
		    }
		  }
		});
	}

	thisItems.selectItem = function(itemId)
	{
		console.log(itemId);
		$.ajax({
			/* ItemController->selectItem() */
		  url : `${baseUrl}/portal/select-item`,
		  method : 'get',
		  dataType: 'json',
		  data : {itemId : itemId},
		  success : function(data)
		  {
		  	$('#txt_itemId').val(data['id']);
		  	$('#txt_editItemNumber').val(data['item_number']);
		  	$('#txt_editItemDescription').val(data['item_description']);
		  	ITEMS.loadBidders('slc_editBidderNumber',data['bidder_id']);
		  	$('#txt_editWinningAmount').val(data['winning_amount']);
		  	$('#modal_editItem').modal('show');
		  }
		});
	}

	thisItems.editItem = function(thisForm)
	{
		let formData = new FormData(thisForm);

		$.ajax({
			/* ItemController->editItem() */
		  url : `${baseUrl}/portal/edit-item`,
		  method : 'post',
		  dataType: 'json',
		  processData: false, // important
		  contentType: false, // important
		  data : formData,
		  success : function(result)
		  {
		    console.log(result);
		    if(result == 'Success')
		    {
          Toast.fire({
		        icon: 'success',
		        title: 'Success! <br>Item updated successfully.',
		      });
          ITEMS.loadItems();
          $('#modal_editItem').modal('hide');
		    }
		    else
		    {
          Toast.fire({
		        icon: 'error',
		        title: `Error! <br>${result}`
		      });
		    }
		  }
		});
	}

	thisItems.removeItem = function(itemId)
	{
		alert('Disabled for now!');
	}

	return thisItems;

})();
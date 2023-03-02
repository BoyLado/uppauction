const ITEMS = (function(){

	let thisItems = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisItems.loadBidders = function()
	{
		$.ajax({
			/* BidderController->loadBidders() */
		  url : `${baseUrl}/portal/load-bidders`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let options = '<option value="">Choose Bidder</option>';

		  	data.forEach(function(value,key){
		  		options += `<option value="${value['id']}">${value['bidder_number']} - ${value['first_name']} ${value['last_name']}</option>`;
		  	});

		  	$('#slc_bidderNumber').html(options).select2();
		  }
		});
	}

	thisItems.loadItems = function()
	{
		$.ajax({
			/* ItemController->loadItems() */
		  url : `${baseUrl}/portal/load-items`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let items = '';
		  	let count = 0;
		  	data.forEach(function(value,key){
		  		items += `<div class="col-sm-12 col-md-6 col-lg-6">
				              <div class="card card-outline card-primary">
				                <div class="card-header">
				                  <h3 class="card-title">Item #${value['item_number']}</h3>
				                </div>
				                <div class="card-body">
				                  <h5>WINNER: <span class="text-primary text-bold">${value['bidder_number']} - ${value['bidder_name']}</span></h5>
				                  <h5>AMOUNT: <span class="text-danger text-bold" id="lbl_amount">$${value['winning_amount']}</span></h5>
				                  <h5>ITEM DESCRIPTION:</h5>
				                  <h6 class="text-muted" id="lbl_description">${value['item_description']}</h6>
				                </div>
				              </div>
				            </div>`;
				  count++;
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
          ITEMS.loadBidders();

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

	}

	thisItems.editItem = function(thisForm)
	{

	}

	thisItems.removeItem = function(itemId)
	{

	}

	return thisItems;

})();
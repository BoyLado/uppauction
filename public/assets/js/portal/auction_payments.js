const PAYMENTS = (function(){

	let thisPayments = {};

	let baseUrl = $('#txt_baseUrl').val();

	function numberWithCommas(x) {
	   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisPayments.loadPayments = function()
	{
		$('body').waitMe(_waitMeLoaderConfig);
		$.ajax({
			/* PaymentController->loadPayments() */
		  url : `${baseUrl}/portal/load-payments`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let tbody = '';
		  	data.forEach(function(value,key){
		  		let sample = JSON.stringify(value['items_id']);
		  		console.log(sample);
		  		tbody += `<tr>
			                <th>${value['created_date']}</th>
			                <th>(${value['bidder_number']})-${value['bidder_name']}</th>
			                <th>${value['sub_total']}</th>
			                <th>${value['tax']}</th>
			                <th>${value['card_transaction_fee']}</th>
			                <th>${value['cash_payment']}</th>
			                <th>${value['card_payment']}</th>
			                <th>${value['total_payment']}</th>
			                <th><a href="javascript:void(0)" onclick='PAYMENTS.loadPaymentDetails(${value['id']},${sample});'>Details</a></th>
			              </tr>`;
		  	});

		  	$('#tbl_payments').DataTable().destroy();
		  	$('#tbl_payments tbody').html(tbody);
		  	$('#tbl_payments').DataTable({
		    	"responsive": true,
		    	"columnDefs": [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 2 },
            {
              "visible": false,
              "searchable": false
            }
	        ],
	        "order": [[ 0, "desc" ]]
		  	});
		  	$('body').waitMe('hide');
		  }
		});
	}

	thisPayments.loadPaymentDetails = function(paymentId,itemsId)
	{
		$.ajax({
			/* PaymentController->loadPaymentDetails() */
		  url : `${baseUrl}/portal/load-payment-details`,
		  method : 'get',
		  dataType: 'json',
		  data : {paymentId:paymentId,itemsId:itemsId},
		  success : function(data)
		  {
		  	$('#modal_paymentDetails').modal('show');

		  	$('#lbl_bidderName').text(data['arrPaymentDetails']['bidder_name']);

		  	let tbody = '';
		  	let number = 1;
		  	let subTotal = 0;
		  	let tax = 0.0954;
		  	let total = 0;
		  	data['arrItemDetails'].forEach(function(value,key){
		  		tbody += `<tr>
                      <td>${number}</td>
                      <td>${value['item_number']}</td>
                      <td>${value['item_description']}</td>
                      <td>${(value['paid'] == 1)? 'PAID':'UNPAID'}</td>
                      <td><span class="float-right">${parseFloat(value['winning_amount']).toFixed(2)}</span></td>
                    </tr>`;
          number++;

          subTotal += parseFloat(value['winning_amount']);
		  	});
		  	
		  	$('#tbl_cart tbody').html(tbody);

		  	tax = subTotal * tax;
		  	total = subTotal + tax;

		  	$('#lbl_subTotal').text(numberWithCommas(subTotal.toFixed(2)));
		  	$('#lbl_tax').text(numberWithCommas(tax.toFixed(2)));
		  	$('#lbl_cardTransactionFee').text("0.00");
		  	$('#lbl_total').text(numberWithCommas(total.toFixed(2)));

		  	$('#txt_cashPayment').val(data['arrPaymentDetails']['cash_payment']);
		  	$('#txt_cardPayment').val(data['arrPaymentDetails']['card_payment']);

		  	let payment = parseFloat(data['arrPaymentDetails']['cash_payment']) + parseFloat(data['arrPaymentDetails']['card_payment']);
		  	let change = payment - parseFloat(data['arrPaymentDetails']['total_payment']);

		  	$('#lbl_change').text(numberWithCommas(change.toFixed(2)));
		  }
		});
	}

	return thisPayments;

})();
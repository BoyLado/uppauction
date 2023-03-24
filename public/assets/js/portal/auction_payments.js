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
			                <th>${(value['card_transaction_fee'] == null)? '0.00' : value['card_transaction_fee']}</th>
			                <th>${(value['cash_payment'] == null)? '0.00' : value['cash_payment']}</th>
			                <th>${(value['card_payment'] == null)? '0.00' : value['card_payment']}</th>
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

		  	$('#lbl_bidderNameHeader').text(data['arrPaymentDetails']['bidder_name']);

		  	let tbody = '';
		  	let number = 0;
		  	let subTotal = 0;
		  	let tax = 0;
		  	let transactionFee = 0;
		  	let total = 0;
		  	data['arrItemDetails'].forEach(function(value,key){
          tbody += `<tr>
                      <td style="border-bottom: 1px dotted black;">
                        <span><b>Auction #${value['item_number']}</b></span><br>
                        <i><span style="font-size: 12px;">${value['item_description']}</span></i>
                      </td>
                      <td style="border-bottom: 1px dotted black;">
                        <span style="float:right;">$ ${parseFloat(value['winning_amount']).toFixed(2)}</span><br><br>
                      </td>
                    </tr>`;
          number++;
          subTotal += parseFloat(value['winning_amount']);
		  	});
		  	
		  	$('#tbl_items tbody').html(tbody);

		  	tax = subTotal * 0.0954;
		  	transactionFee = (subTotal + tax) * 0.0435;
		  	total = subTotal + tax + transactionFee;

		  	$('#lbl_subTotal').text(numberWithCommas(subTotal.toFixed(2)));
		  	$('#lbl_tax').text(numberWithCommas(tax.toFixed(2)));
		  	$('#lbl_cardTransactionFee').text(transactionFee.toFixed(2));
		  	$('#lbl_total').text(numberWithCommas(total.toFixed(2)));

		  	//////////////////////////////////////////////////////////////////////

		  	$('#lbl_bidderNumber').html(data['arrPaymentDetails']['bidder_number']);
		  	$('#lbl_numberOfItems').html(number);

		  	let receipt = '';
        if(data['arrPaymentDetails']['id'] < 10)
        {
            receipt = `00000${data['arrPaymentDetails']['id']}`;
        }
        else if(data['arrPaymentDetails']['id'] < 100)
        {
            receipt = `0000${data['arrPaymentDetails']['id']}`;
        }
        else if(data['arrPaymentDetails']['id'] < 1000)
        {
            receipt = `000${data['arrPaymentDetails']['id']}`;
        }
        else if(data['arrPaymentDetails']['id'] < 10000)
        {
            receipt = `00${data['arrPaymentDetails']['id']}`;
        }
        else if(data['arrPaymentDetails']['id'] < 100000)
        {
            receipt = `0${data['arrPaymentDetails']['id']}`;
        }
        else
        {
            receipt = data['arrPaymentDetails']['id'];
        }
		  	$('#lbl_receiptNumber').html(receipt);

		  	$('#lbl_bidderName').html(data['arrPaymentDetails']['bidder_name']);
		  	$('#lbl_bidderEmailAddress').html(data['arrPaymentDetails']['email']);
		  	$('#lbl_bidderPhoneNumber').html(data['arrPaymentDetails']['phone_number']);
		  	$('#lbl_bidderAddress').html(data['arrPaymentDetails']['address']);
		  }
		});
	}

	return thisPayments;

})();
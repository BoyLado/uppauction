const PAYMENTS = (function(){

	let thisPayments = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisPayments.loadPayments = function()
	{
		$.ajax({
			/* PaymentController->loadPayments() */
		  url : `${baseUrl}/portal/load-payments`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let tbody = '';
		  	data.forEach(function(value,key){
		  		tbody += `<tr>
			                <th>${value['created_date']}</th>
			                <th>(${value['bidder_number']})-${value['bidder_name']}</th>
			                <th>${value['sub_total']}</th>
			                <th>${value['tax']}</th>
			                <th>${value['card_transaction_fee']}</th>
			                <th>${value['cash_payment']}</th>
			                <th>${value['card_payment']}</th>
			                <th>${value['total_payment']}</th>
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
		  }
		});
	}

	return thisPayments;

})();
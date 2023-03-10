
const PRE_REGISTRATION = (function(){

	let thisPreRegistration = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
  });

	thisPreRegistration.loadAuctionDates = function()
	{
		$.ajax({
			/* PreRegistrationController->loadAuctionDates() */
		  url : `${baseUrl}/load-auction-dates`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let options = '<option value="">Choose Date</option>';
		  	data.forEach(function(value,key){
		  		options += `<option value="${value['id']}">${value['auction_date']}</option>`;
		  	});
		  	$('#slc_auctionDate').html(options);
		  }
		});
	}

	thisPreRegistration.removeGuest = function(thisButton)
	{
		if(confirm('Please confirm!'))
		{
			$(thisButton).parents('.row').remove();
		}
	}

	thisPreRegistration.submitWithSeasonPass = function(thisForm)
	{
		if($('#chk_agree').is(':checked'))
		{
			let arrGuest = [];
			$('#div_guest .guest-form').each(function(){
				arrGuest.push({
					'first_name' 		: $(this).find('input:eq(0)').val(),
					'last_name' 		: $(this).find('input:eq(1)').val(),
					'email_address'	: $(this).find('input:eq(2)').val(),
					'relationship'	: $(this).find('select').val(),
				});
			});

			let formData = new FormData(thisForm);

			formData.append("chk_guest", $('#chk_guests').is(':checked')? 1 : 0);
			formData.append("arrGuest", JSON.stringify(arrGuest));

			$('#btn_submit').html('<i>Please wait</i>');
			$('#btn_submit').prop('disabled',true);

			$.ajax({
				/* PreRegistrationController->preRegistrationWithSeasonPass() */
			  url : `${baseUrl}/pre-registration-with-season-pass`,
			  method : 'post',
			  dataType: 'json',
			  processData: false, // important
			  contentType: false, // important
			  data : formData,
			  success : function(result)
			  {
			    console.log(result);
			    $('#btn_submit').html('Submit');
			    $('#btn_submit').prop('disabled',false);
			    if(result == 'Success')
			    {
			      $('#modal_successValidation').modal({'backdrop':'static'});
			    }
			    else
			    {
			      $('#modal_errorValidation').modal({'backdrop':'static'});
			    }
			  }
			});
		}
		else
		{
      Toast.fire({
        icon: 'warning',
        title: 'Warning! <br>Please read & accept TERMS and CONDITIONS.',
      });
		}
	}

	thisPreRegistration.submitWithOutSeasonPass = function(thisForm)
	{
		if($('#chk_agree').is(':checked'))
		{
			let formData = new FormData(thisForm);

			$('#btn_submit').html('<i>Please wait</i>');
			$('#btn_submit').prop('disabled',true);

			$.ajax({
				/* PreRegistrationController->preRegistrationWithOutSeasonPass() */
			  url : `${baseUrl}/pre-registration-without-season-pass`,
			  method : 'post',
			  dataType: 'json',
			  processData: false, // important
			  contentType: false, // important
			  data : formData,
			  success : function(result)
			  {
			    console.log(result);
			    $('#btn_submit').html('Submit');
			    $('#btn_submit').prop('disabled',false);
			    if(result == 'Success')
			    {
			      $('#modal_successValidation').modal({'backdrop':'static'});
			    }
			    else
			    {
			      $('#modal_errorValidation').modal({'backdrop':'static'});
			    }
			  }
			});
		}
		else
		{
      Toast.fire({
        icon: 'warning',
        title: 'Warning! <br>Please read & accept TERMS and CONDITIONS.',
      });
		}
	}

	return thisPreRegistration;

})();
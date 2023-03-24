const CONTACT_US = (function(){

	let thisContactUs = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000
  });

	thisContactUs.sendEmail = function(thisForm)
	{
		let formData = new FormData(thisForm);
		$('#btn_sendMessage').html('<i>Please wait...</i>');
		$('#btn_sendMessage').prop('disabled',true);
		$.ajax({
			/* ContactUsController->sendEmail() */
		  url : `${baseUrl}/send-email`,
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
		        title: 'Success! <br>Message sent successfully!',
		      });
		      setTimeout(function(){
            window.location.replace(`${baseUrl}/contact-us`);
          }, 1000);
		    }
		    else
		    {
		    	// if(result == "reCatchaErr")
		    	// {
		    	//     alert('Sorry Google Recaptcha Unsuccessful!!');
		    	// }
		    	// else
		    	// {
		    	//     location.reload();
		    	// }
          Toast.fire({
		        icon: 'error',
		        title: `Error! <br>${result}`
		      });
		    }

		    $('#btn_sendMessage').html('<i class="fa fa-paper-plane mr-2"></i> Send Message');
		    $('#btn_sendMessage').prop('disabled',false);
		  }
		});
	}



	return thisContactUs;

})();
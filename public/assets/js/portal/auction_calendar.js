const CALENDAR = (function(){

	let thisCalendar = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});

	thisCalendar.loadAuctions = function()
	{
		$('body').waitMe(_waitMeLoaderConfig);
		$.ajax({
			/* AuctionController->loadAuctions() */
		  url : `${baseUrl}/portal/load-auctions`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	console.log(data);
		  	let arrAuctionEvents = [];
		  	data.forEach(function(value,key){
		  		let arrEvents = [];
		  		arrEvents['id'] 		= value['id'];
		  		arrEvents['title'] 	= `${value['auction_title']} - ${value['auction_description']}`;
		  		arrEvents['start'] 	= value['auction_date'];
		  		arrEvents['end'] 		= value['auction_date'];
		  		arrAuctionEvents.push(arrEvents);
		  	});

		  	console.log(arrAuctionEvents);

		  	let objCalendar = new FullCalendar.Calendar(document.getElementById(`div_calendars`),{
		  	  headerToolbar: {
		  	    left  : 'prev,next today',
		  	    center: 'title',
		  	    right : 'dayGridMonth,timeGridWeek,timeGridDay'
		  	  },
		  	  themeSystem: 'bootstrap',
		  	  events: arrAuctionEvents,
		  	  eventTimeFormat: { hour: 'numeric', minute: '2-digit', timeZoneName: 'short' },
		  	  eventClick:function(info)
		  	  {
		  	  	let eventObj = info.event;
		  	  	CALENDAR.selectAuction(eventObj.id);
		  	  }
		  	});
		  	objCalendar.render();
		  	$('body').waitMe('hide');
		  }
		});
	}

	thisCalendar.selectAuctionDates = function(auctionId = null)
	{
		$.ajax({
			/* AuctionController->loadAuctionDates() */
		  url : `${baseUrl}/portal/load-auction-dates`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		  	let options = `<option value="">Choose Date</option>`;

		  	data.forEach(function(value,key){
		  		if(value['id'] == auctionId)
		  		{
		  			options += `<option value="${value['id']}" selected>${value['auction_date']}</option>`;
		  		}
		  		else
		  		{
		  			options += `<option value="${value['id']}">${value['auction_date']}</option>`;
		  		}
		  	});

		  	$('#slc_auctionDate').html(options);
		  }
		});
	}

	thisCalendar.selectAuction = function(auctionId)
	{
		$.ajax({
	  	/* AuctionController->selectAuction() */
	    url : `${baseUrl}/portal/select-auction`,
		  method : 'get',
		  dataType: 'json',
		  data : {auctionId : auctionId},
		  success : function(data)
		  {
		  	if(data == null)
		  	{
		  		alert('Auction Event was expired already, Please choose future dates!');
		  	}
		  	else
		  	{
		  		CALENDAR.selectAuctionDates(auctionId);
		  		$('#modal_preRegistration').modal('show');
		  	}
		  }
		});
	}

	thisCalendar.removeGuest = function(thisButton)
	{
		if(confirm('Please confirm!'))
		{
			$(thisButton).parents('.row').remove();
		}
	}

	thisCalendar.submitPreRegistration = function(thisForm)
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

			$('#btn_submitForm').html('<i>Please wait</i>');
			$('#btn_submitForm').prop('disabled',true);

			$.ajax({
			/* AuctionController->submitPreRegistration() */
		  url : `${baseUrl}/portal/submit-pre-registration`,
		  method : 'post',
		  dataType: 'json',
		  processData: false, // important
		  contentType: false, // important
		  data : formData,
		  success : function(result)
		  {
		    console.log(result);
		    $('#btn_submitForm').html('Submit');
		    $('#btn_submitForm').prop('disabled',false);
		    if(result == 'Success')
		    {
          Toast.fire({
		        icon: 'success',
		        title: 'Success! <br>Pre Registration Completed successfully.',
		      });

		      setTimeout(function(){
            window.location.replace(`${baseUrl}/portal/auction-calendar`);
          }, 1000);
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
		else
		{
      Toast.fire({
        icon: 'warning',
        title: 'Warning! <br>Please read & accept TERMS and CONDITIONS.',
      });
		}
	}

	return thisCalendar;

})();
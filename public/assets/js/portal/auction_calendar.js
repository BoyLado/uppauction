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
		  	  	alert(eventObj.id);
		  	  }
		  	});
		  	objCalendar.render();
		  	$('body').waitMe('hide');
		  }
		});
	}

	thisCalendar.addAuction = function(thisForm)
	{
		let formData = new FormData(thisForm);

		$.ajax({
			/* AuctionController->addAuction() */
		  url : `${baseUrl}/portal/add-auction`,
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
		        title: 'Success! <br>New auction event saved successfully.',
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
		  	$('#txt_auctionId').val(data['id']);
		  }
		});
	}

	thisCalendar.editAuction = function(thisForm)
	{
		let formData = new FormData(thisForm);

		$.ajax({
			/* AuctionController->editAuction() */
		  url : `${baseUrl}/portal/edit-auction`,
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
		        title: 'Success! <br>Auction event updated successfully.',
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

	thisCalendar.removeAuction = function(auctionId)
	{

	}

	return thisCalendar;

})();
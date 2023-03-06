const WINNERS = (function(){

	let thisWinners = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});


	thisWinners.loadWinners = function(textSearch = "")
	{
		let dateFilter = $('#txt_dateFilter').val();
		$.ajax({
			/* WinnerController->loadWinners() */
		  url : `${baseUrl}/portal/load-winners`,
		  method : 'get',
		  dataType: 'json',
		  data:{order:'DESC', dateFilter:dateFilter, textSearch : textSearch},
		  success : function(data)
		  {
  	    let bidders = '';
  	    data.forEach(function(value,key){
  	    	let imgSrc = (value['season_pass'] != null)? value['season_pass'] : `${baseUrl}/public/assets/uploads/images/bidders/${value['id_picture']}`;
  	    	let bidderName = (value['first_name'] != null)? `${value['first_name']} ${value['last_name']}` : '---';
  	    	let email = (value['email'] != null)? value['email'] : '---';
  	    	
  	    	bidders += `<div class="col-md-6 col-lg-6 col-xl-3 pt-2">
  						          <div class="card mb-2 bg-gradient-dark zoom">
  						            <a href="javascript:void(0)" onclick="WINNERS.loadWinnerItems(${value['id']});">
  						              <img class="card-img-top rounded" src="${imgSrc}" alt="" style="height: 300px; width: 100%; object-fit: cover;">
  						              <div class="products">
  						                <h5 class="card-title text-primary text-white">
  						                  <span class="text-bold text-red">Bidder #${value['bidder_number']}</span> | ${bidderName}</h5>
  						                <br>
  						                <span class="card-text text-muted">${email}</span>
  						                <div class="float-right">
  						                <span class="text-red text-bold">PAID</span>
  						                </div>
  						              </div>
  						            </a>
  						          </div>
  						        </div>`;
  	    });

  	    if(bidders == '')
  	    {
  	    	bidders = '<div class="col-md-12 col-lg-12 col-xl-12 pt-2"><center><h5>No Auction Schedule!</h5></center>';
  	    }

  	    $('#div_winners').html(bidders);
		  }
		});
	}

	thisWinners.loadWinnerItems = function(bidderId)
	{
		$.ajax({
			/* WinnerController->loadWinnerItems() */
		  url : `${baseUrl}/portal/load-winner-items`,
		  method : 'get',
		  dataType: 'json',
		  data:{bidderId:bidderId},
		  success : function(data)
		  {
		  	console.log(data);
		  	$('#modal_checkout').modal('show');
		  }
		});
	}

	return thisWinners;

})();
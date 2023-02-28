const BIDDERS = (function(){

	let thisBidder = {};

	let baseUrl = $('#txt_baseUrl').val();

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top',
	  showConfirmButton: false,
	  timer: 3000
	});


	thisBidder.loadBidders = function()
	{
		$.ajax({
			/* BidderController->loadBidders() */
		  url : `${baseUrl}/portal/load-bidders`,
		  method : 'get',
		  dataType: 'json',
		  success : function(data)
		  {
		    console.log(data);
		    let bidders = '';
		    data.forEach(function(value,key){
		    	let imgSrc = (value['season_pass'] != null)? value['season_pass'] : `${baseUrl}/public/assets/uploads/images/bidders/${value['id_picture']}`;
		    	let bidderName = (value['first_name'] != null)? `${value['first_name']} ${value['last_name']}` : '---';
		    	let address = (value['address'] != null)? value['address'] : '---';
		    	
		    	bidders += `<div class="col-md-6 col-lg-6 col-xl-3 pt-2">
							          <div class="card mb-2 bg-gradient-dark grow">
							            <a href="javascript:void(0)" onclick="alert();">
							              <img class="card-img-top rounded" src="${imgSrc}" alt="" style="height: 300px; width: 100%; object-fit: cover;">
							              <div class="products">
							                <h5 class="card-title text-primary text-white">
							                  <span class="text-bold text-red">Bidder #${value['bidder_number']}</span> | ${bidderName}</h5>
							                <br>
							                <span class="card-text text-muted">${address}</span>
							                <div class="float-right">
							                  <a href="javascript:void(0)" onclick="BIDDERS.selectBidder(${value['id']})" >Edit</a> |
							                  <a href="javascript:void(0)" onclick="BIDDERS.removeBidder(${value['id']})" >Delete</a>
							                </div>
							              </div>
							            </a>
							          </div>
							        </div>`;
		    });

		    $('#div_bidders').html(bidders);
		  }
		});
	}

	thisBidder.uploadBidderPicturePreview = function(imageFile)
	{
	  let fileLen = imageFile.files.length;

	  if(fileLen > 0)
	  {
	    let imageName = imageFile.files[0]['name'];
	    let imageSize = imageFile.files[0]['size'] / 1000;
	    let imageStatus = '';
	    let fileType = ['image/jpg','image/jpeg','image/png','image/gif'];
	    let numRows = 0;

	    if(imageSize > 3024)
	    {
	      imageStatus = '<span class="info-bot-number text-danger">Image size must be not greater than 3mb!</span>';
	    }
	    else if(!fileType.includes(imageFile.files[0]['type']))
	    {
	      imageStatus = '<span class="info-bot-number text-danger">Not an image file!</span>';
	    }
	    else
	    {
	      imageStatus = '<span class="info-bot-number text-success">Good to go!</span>';
	    }

	    var reader = new FileReader();
	    reader.onload = function(e) 
	    {
	      let strImage = `<img class="profile-user-img img-fluid" style="width: 100%; object-fit: cover;"
	                       src="${e.target.result}"
	                       alt="User profile picture">`;
	      $('#div_addImagePreview').html(strImage);

	      $('#lbl_fileName').html(imageName);
	      $('#lbl_fileSize').html(`(${imageSize.toFixed(2)} KB)`);
	      $('#lbl_fileStatus').html(imageStatus);

	      $('#div_addImageDetails').show();
	    }
	    reader.readAsDataURL(imageFile.files[0]);
	  }
	  else
	  {
	    $('#div_addImagePreview').html(`<img class="profile-user-img img-fluid img-circle" id="img_profilePicture"
	                       src="${baseUrl}/public/assets/img/user-placeholder.png"
	                       alt="User profile picture">`);

	    $('#lbl_fileName').html('');
	    $('#lbl_fileSize').html('');
	    $('#lbl_fileStatus').html('');

	    $('#div_addImageDetails').hide();

	    alert('Please select image file.');
	  }
	}

	thisBidder.addBidder = function(thisForm)
	{
		let formData = new FormData(thisForm);

		formData.append("idPicture", $('#file_addIdPicture')[0].files[0]);

		$.ajax({
			/* BidderController->addBidder() */
		  url : `${baseUrl}/portal/add-bidder`,
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
		    	$('#modal_addBidder').modal('hide');
          Toast.fire({
		        icon: 'success',
		        title: 'Success! <br>New bidder added successfully.',
		      });
		      setTimeout(function(){
            window.location.replace(`${baseUrl}/portal/auction-bidders`);
          }, 1000);
		    }
		    else
		    {
          Toast.fire({
		        icon: 'error',
		        title: `Error! <br>${result}`
		      });

		      $('#txt_addBidderNumber').val('').focus();
		    }
		  }
		});
	}

	thisBidder.selectBidder = function(bidderId)
	{
		$.ajax({
			/* BidderController->selectBidder() */
		  url : `${baseUrl}/portal/select-bidder`,
		  method : 'get',
		  dataType: 'json',
		  data : {bidderId : bidderId},
		  success : function(data)
		  {
		  	console.log(data);
		  	$('#div_editImageDetails').hide();
		  	$('#modal_editBidder').modal('show');

		  	let img_editIdPicture = `<img class="profile-user-img img-fluid" style="width: 100%; object-fit: cover;" id="img_editIdPicture"
	                               src="${baseUrl}/public/assets/uploads/images/bidders/${data['id_picture']}"
	                               alt="User profile picture">`;
		  	$('#div_editImagePreview').html(img_editIdPicture);

		  	$('#txt_bidderId').val(data['id']);

		  	$('#txt_editBidderNumber').val(data['bidder_number']);
		  	$('#txt_firstName').val(data['first_name']);
		  	$('#txt_lastName').val(data['last_name']);
		  	$('#txt_address').val(data['address']);
		  	$('#txt_phoneNumber').val(data['phone_number']);
		  	$('#txt_email').val(data['email']);
		  	$('#txt_idNumber').val(data['id_number']);
		  	$('#txt_seasonPassLink').val(data['season_pass']);
		  }
		});
	}

	thisBidder.editBidder = function(thisForm)
	{
		let formData = new FormData(thisForm);

		formData.append("idPicture", $('#file_addIdPicture')[0].files[0]);

		$.ajax({
			/* BidderController->editBidder() */
		  url : `${baseUrl}/portal/edit-bidder`,
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
		    	$('#modal_editBidder').modal('hide');
          Toast.fire({
		        icon: 'success',
		        title: 'Success! <br>Bidder updated successfully.',
		      });
		      setTimeout(function(){
            window.location.replace(`${baseUrl}/portal/auction-bidders`);
          }, 1000);
		    }
		    else
		    {
          Toast.fire({
		        icon: 'error',
		        title: `Error! <br>${result}`
		      });

		      $('#txt_addBidderNumber').val('').focus();
		    }
		  }
		});
	}

	thisBidder.removeBidder = function(bidderId)
	{
		if(confirm('Please Confirm'))
		{
			let formData = new FormData();

			formData.set("bidderId", bidderId);

			$.ajax({
				/* BidderController->removeBidder() */
			  url : `${baseUrl}/portal/remove-bidder`,
			  method : 'post',
			  dataType: 'json',
			  processData: false, // important
			  contentType: false, // important
			  data : formData,
			  success : function(result)
			  {
			    if(result == 'Success')
			    {
	          Toast.fire({
			        icon: 'success',
			        title: 'Success! <br>Bidder removed successfully.',
			      });
			      setTimeout(function(){
	            window.location.replace(`${baseUrl}/portal/auction-bidders`);
	          }, 1000);
			    }
			    else
			    {
	          Toast.fire({
			        icon: 'error',
			        title: 'Error! <br>Database error!'
			      });
			    }
			  }
			});
		}
	}

	function urlencode(obj, prefix) {
	    str = (obj + '').toString();
	    return encodeURIComponent(str)
	        .replace(/!/g, '%21')
	        .replace(/'/g, '%27')
	        .replace(/\(/g, '%28')
	        .replace(/\)/g, '%29')
	        .replace(/\*/g, '%2A')
	        .replace(/%20/g, '+');
	        // .replace(/~/g, '%7E');
	}

	thisBidder.checkCSVFile = function(thisInput)
	{
		var fileName = thisInput.files[0].name;

		let formData = new FormData();
		formData.set('seasonPassList',thisInput.files[0],fileName);
		

		$('#lbl_loader').show();
		$('#div_checkResult').hide();
		$('#div_errorResult').hide();
		$('#btn_submitSeasonPassList').prop('disabled',true);
		$.ajax({
			url : `${baseUrl}/portal/check-upload-file`,
			method : 'POST',
			dataType: 'json',
			processData: false, // important
			contentType: false, // important
			data : formData,
			success : function(result)
			{
				console.log(result);
				checkFileResult = result;
				$('#lbl_loader').hide();
				if(result['upload_res'] == "")
				{
					let forUpdate = result['for_update'].length;
					let forInsert = result['for_insert'].length;
					let conflictRows = result['conflict_rows'].length;

					$('#lbl_forUpdate').text(forUpdate);
					$('#lbl_forInsert').text(forInsert);
					$('#lbl_conflictRows').text(conflictRows);
					$('#div_checkResult').show();
					(conflictRows == 0)? $('#lbl_download').hide() : $('#lbl_download').show();

					let conflictRowData = result['conflict_rows'];
					
					var myJSON = JSON.stringify(conflictRowData);
					var trafficFilterHolder = urlencode(myJSON);
						
					$('#lnk_download').attr('href','<?php echo base_url(); ?>/portal/download-conflicts/'+trafficFilterHolder);

					if(forUpdate != 0 || forInsert != 0)
					{
						$('#btn_submitSeasonPassList').prop('disabled',false);
					}
				}
				else
				{
					$('#div_errorResult > p').text(result['upload_res']);
					$('#div_errorResult').show();
				}
			}
		});
	}

	return thisBidder;

})();
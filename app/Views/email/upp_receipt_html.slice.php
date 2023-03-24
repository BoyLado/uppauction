<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body style="font-family: Arial, sans-serif;">
 
  <center>
    <img src="<?php echo base_url(); ?>/public/assets/img/payment_receipt.jpeg" style="width: 300px;" alt="AdminLTE Logo">
  </center>
  
  <hr>

  <center>
  	<div>
  	  <p>Hello <b>Bidder Number {{ $bidderNumber }}</b>,</p>
  	  <p>Congratulations! You have won ({{ $numberOfItems }}) items from the auction today.</p>

  	  <br>
  	  
  	  <p><b>Receipt #{{ $receiptNumber }}</b></p>
  	  <p>{{ $dateSent }}</p>

  	  <br>

  	  <p>Customer</p>
  	  <p><b>{{ $bidderName }}</b></p>
  	  <a href="javascript:void(0)">{{ $bidderEmailAddress }}</a>
  	  <p>{{ $bidderPhoneNumber }}</p>
  	  <p>{{ $bidderAddress }}</p>
  	</div>

  	<br>

  	<h4>PAYMENT SUMMARY</h4>

  	<table style="width:50%">
  	  @foreach($arrItems as $key => $value)
  	    <tr>
  	      <td style="border-bottom: 1px dotted black;">
  	        <span><b>Auction #{{ $value['item_number'] }}</b></span><br>
  	        <i><span style="font-size: 12px;">{{ $value['item_description'] }}</span></i>
  	      </td>
  	      <td style="border-bottom: 1px dotted black;">
  	        <span style="float:right;">$ {{ $value['winning_amount'] }}</span><br><br>
  	      </td>
  	    </tr>
  	  @endforeach
  	</table>
  	<table style="width:50%">
  	  <tr>
  	    <td style="width: 50%;"><b>Subtotal:</b></td>
  	    <td><span style="float:right;"><b>$ {{ $subTotal }}</b></span></td>
  	  </tr>
  	  <tr>  
  	    <td style="width: 50%;">Sales tax:</td>
  	    <td><span style="float:right;">$ {{ $tax }}</span></td>
  	  </tr>
  	  <tr>
  	    <td style="border-bottom: 1px dotted black; width: 50%;">Transaction Fee:</td>
  	    <td style="border-bottom: 1px dotted black;"><span style="float:right;">$ {{ $card_transaction_fee }}</span></td>
  	  </tr>
  	  <tr>
  	    <td style="width: 50%;"><b>Total:</b></td>
  	    <td><span style="float:right;"><b>$ {{ $total_payment }}</b></span></td>
  	  </tr>
  	</table>
  </center>

  <hr>

  <center>
    <p><b>Thank you for being a great customer!</b></p>
    <p>U Pick A Pallet LLC</p>
    <p>323 Broadway Street</p>
    <p>Mount Vernon, IL 62864-5115 United States</p>
    <a href="mailto:customerservice@upickapallet.com">customerservice@upickapallet.com</a>
    <p>(618) 270 - 4207</p>
  </center>

</body>
</html>
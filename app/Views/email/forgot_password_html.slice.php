<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<label>Bidder ID: {{ $bidderId }}</label>
	<label>Bidder Name: {{ $bidderName }}</label>
	<label>Auth Code: {{ $bidderAuthCode }}</label>
	<br>
	<a href="<?php echo base_url(); ?>/change-password/{{ $bidderId }}/{{ $bidderAuthCode }}">Change Password</a>
</body>
</html>
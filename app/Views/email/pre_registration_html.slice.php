<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<label>Bidder Number: {{ ($bidderSeasonPassNumber == "")? $bidderNumber : $bidderSeasonPassNumber }}</label><br>
	<label>Email: {{ $bidderEmailAddress }}</label><br>
	<label>Auth Code: {{ $bidderAuthCode }}</label>

	<br>
	<a href="<?php echo base_url(); ?>/confirm-pre-registration/{{ $bidderId }}/{{ $bidderAuthCode }}">Confirm</a>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
</head>
<body style="font-family: Arial, sans-serif;">

  <center>
    <img src="<?php echo base_url(); ?>/public/assets/img/email_verification.jpeg" alt="Email Verification Logo">
  </center>
  <center>
    <p>Hello Bidder Number <b>{{ ($bidderSeasonPassNumber == "")? $bidderNumber : $bidderSeasonPassNumber }}</b>,</p>
    <p>Thank you for signing up to U Pick A Pallet Auction Services. <br>To get started, we need to verify your email address <code style="background:lightgray; padding:3px; border-radius:2px;"><a href="javascript:void(0)">{{ $bidderEmailAddress }}</a></code>.
    </p>
    <p>To activate your account, <br>please use this link <code style="background:lightgray; padding:3px; border-radius:2px;"><?php echo base_url(); ?>/confirm-pre-registration/{{ $bidderId }}/{{ $bidderAuthCode }}</code>, or simply click the button below to verify your email address.</p>
  </center>

  <br><br><br>
  <center>
    <a href="<?php echo base_url(); ?>/confirm-pre-registration/{{ $bidderId }}/{{ $bidderAuthCode }}" style="color: white; background: #6EC1E4; border-radius: 5px; border: 1px solid #ddd; padding:20px; text-decoration: none;" >Verify Your Email Address
    </a>
  </center>
  <br><br><br>

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
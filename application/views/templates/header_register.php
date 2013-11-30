<html>
<head>
    <meta name="viewport" content="initial-scale=1.0">

    <title><?php echo $title ?> QR Hunt</title>

    <?php if (!get_cookie('event_id')){ ?>
        <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo base_url("assets/css/default.php");?>"/>
        <link href="<?php echo base_url("assets/css/styles.css"); ?>" rel="stylesheet" type="text/css" media="screen and (min-width:799px)"/>
        <link rel="stylesheet" type="text/css" media="screen and (min-device-width:320px)" href="<?php echo base_url("assets/css/mobile.css");?>"/>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo site_url("css/get");?>"/>
        <link rel="stylesheet" type="text/css" media="screen and (min-device-width:320px)" href="<?php echo base_url("assets/css/mobile.css");?>"/>
    <?php } ?>

    <script src="/qrhunt/application/JavaScript/qrcode_SJIS.js" type="text/javascript"></script>
    <script src="/qrhunt/application/JavaScript/qrcode.js" type="text/javascript"></script>
    <script src="/qrhunt/application/JavaScript/generate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

</head>
<body>
<div class="wrap">
    <!--Make Header a link back to homepage-->
    <a style="display:block" href="<?php echo site_url()?>">

    <div class="header">
        <div class = "logo">

         </div>
    </div>

    </a>
    <!--End Header-->
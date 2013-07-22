<html>
<head>

    <title><?php echo $title ?> QR Hunt</title>

    <?php if (!get_cookie('event_id')){ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/default.php");?>"/>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url("css/get");?>"/>
        <?php } ?>
</head>
<body>
    <div class="wrap">
    <div class="header">
        <div class = "logo">
	        <h1>QR Hunt</h1>
         </div>
    </div>

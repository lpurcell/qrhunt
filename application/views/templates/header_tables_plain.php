<html>
<head>


    <title><?php echo $title ?> QR Hunt</title>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
        @import "<?php echo base_url()?>assets/DataTables/media/css/demo_table.css";
    </style>

    <?php if (!get_cookie('event_id')){ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/default.php");?>"/>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url("css/get");?>"/>
    <?php } ?>

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
<html>
<head>


    <title><?php echo $title ?> QR Hunt</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link type="text/css "rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.minicolors.js"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url()?>assets/css/jquery.minicolors.css" />
    <?php if (!get_cookie('event_id')){ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/default.php");?>"/>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url("css/get");?>"/>
    <?php } ?>

    <script type="text/javascript">
        $(function() {
            $( "#datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
            });

            $('INPUT[type=minicolors_main]').minicolors({
                    defaultValue: '#ebca0e',
                    theme: 'no theme'
                });

            $('INPUT[type=minicolors_text]').minicolors({
                defaultValue: '#000000',
                theme: 'no theme'
            });

            $('INPUT[type=minicolors_header]').minicolors({
                defaultValue: '#82817b',
                theme: 'no theme'
            });
        });
    </script>

</head>
<body>
<div class="wrap">
    <div class="header">
        <div class = "logo">

        </div>
    </div>

    <h1><a href="<?php echo site_url()?>">QR Hunt</a></h1>
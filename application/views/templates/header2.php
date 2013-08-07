<html>
<head>


    <title><?php echo $title ?>-QR Hunt</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link type="text/css "rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.minicolors.js"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url()?>assets/css/jquery.minicolors.css" />

    <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo base_url("assets/css/default.php");?>"/>
    <link rel="stylesheet" type="text/css" media="screen and (min-device-width:320px)" href="<?php echo base_url("assets/css/mobile.php");?>"/>

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
            <img src="<?php echo base_url()?>assets/images/GELogoEdited.jpg" alt="Logo" title="Logo" />


        </div>
    </div>
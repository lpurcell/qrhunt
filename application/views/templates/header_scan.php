<html>
<head>


    <title><?php echo $title ?> QR Hunt</title>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <link type="text/css "rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url("css/get");?>"/>

    <script type="text/javascript">
        $(function() {
            $( "#datepicker" ).datepicker({
                dateFormat: "yy-mm-dd"
            });

        });
    </script>

</head>
<body>
<div class="wrap">
    <div class="header">
        <div class = "logo">
            <h1>QR Hunt</h1>


        </div>
    </div>
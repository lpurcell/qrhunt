<html>
<head>
    <meta name="viewport" content="initial-scale=1.0">

    <title><?php echo $title ?> QR Hunt</title>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
        @import "<?php echo base_url()?>assets/DataTables/media/css/demo_table.css";
    </style>

    <?php if (!get_cookie('event_id')){ ?>
        <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo base_url("assets/css/default.php");?>"/>
        <link href="<?php echo base_url("assets/css/styles.css"); ?>" rel="stylesheet" type="text/css" media="screen and (min-width:799px)"/>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo site_url("css/get");?>"/>
    <?php } ?>

    <script type="text/javascript">
    $(document).ready( function () {


        // New record
        $('a.editor_create').on('click', function (e) {

            e.preventDefault();

            editor.create(
                'Create new record',
                { "label": "Add", "fn": function () { editor.submit() } }
            );
        } );

        // Edit record
        $('a.editor_edit').on('click', function (e) {
            e.preventDefault();

            editor.edit(
                $(this).parents('tr')[0],
                'Edit record',
                { "label": "Update", "fn": function () { editor.submit() } }
            );
        } );

        // Delete a record
        $('a.editor_remove').on('click', function (e) {
            e.preventDefault();

            editor.message( "Are you sure you wish to delete this row?" );
            editor.remove(
                $(this).parents('tr')[0],
                'Delete Row',
                { "label": "Delete", "fn": function () { editor.submit() } }
            );
        } );
        //view individual items on event_all table and participant_all table
        $('a.view').on('click', function (e) {
            e.preventDefault();
        });

        /* Init DataTables */
        var oTable = $('#table_id').dataTable();

        /* Apply the tooltips */
        $( oTable.fnGetNodes() ).tooltip( {
            "delay": 0,
            "track": true,
            "fade": 250
        });

     } );
    </script>

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
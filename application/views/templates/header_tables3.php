<html>
<head>


    <title><?php echo $title ?>-QR Hunt</title>

    <meta name="viewport" content="initial-scale=1.0">
    <link rel="icon" href="<?php echo base_url("assets/images/favicon.ico")?>">

    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.js"></script>
    <script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>assets/DataTables/media/js/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
        @import "<?php echo base_url()?>assets/DataTables/media/css/demo_table.css";
    </style>

    <link rel="stylesheet" type="text/css" media="screen and (min-width:799px)" href="<?php echo base_url("assets/css/default.css");?>"/>
    <link rel="stylesheet" type="text/css" media="screen and (min-device-width:320px)" href="<?php echo base_url("assets/css/mobile.css");?>"/>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#table_id').dataTable({
                "aoColumns"   : [{"sWidth": "2%" }, {"sWidth": "2%"}, {"sWidth": "2%"}]
            });

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
    <div class="header">
        <div class = "logo">
            <a href="<?php echo site_url() ?>"><img src="<?php echo base_url()?>assets/images/GELogoEdited.jpg" alt="Logo" title="Logo" /></a>
        </div>
    </div>

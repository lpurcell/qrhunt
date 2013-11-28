<?php

    echo '<h2>'.$title.'</h2>';

?>

<table id="table_id" class="display">
    <p>Table shows participants from all events. To view a specific event, select an event from the drop down menu.</p>
    <p>Filter by Event:
        <select id="table_id_select">
            <option></option>
            <?php foreach($events as $event):
                echo "<option value='".$event->Event_ID."'>".$event->Event_Name."</option>";

            endforeach;
            ?>
        </select>

    <thead>
    <tr>
        <th>Event Name</th>
        <th>QR Code</th>
        <th>Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Admin</th>
    </tr>
    </thead>
    <tbody>

    <?php
    echo '<tr>';
    foreach ($scan_info as $info):
        foreach ($scans as $scan):
            if($info->Participant_ID == $scan->Participant_ID){
                echo '<td>'.$scan->Event_ID.'</td>';
                echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';
                echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
                echo '<td>'.$scan->Date.'</td>';
                echo '<td>'.$scan->Time.'</td>';
                echo '<td><a href="'.site_url('admin/scan_edit/'.$info->Participant_ID.'/'.$qrcode_lookup).'" id="view">Edit</a> / <a href="'.site_url('admin/scan_delete/'.$info->Participant_ID.'/'.$qrcode_lookup).'" id="view">Delete</a></td>';
            }
        endforeach;

    echo '</tr>';
    endforeach ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').dataTable({
            "bSort":true,
            "bFilter":true,

            "aoColumns": [{ "bSearchable": true,
                "bVisible": false }, null, null, null, null, null]
        });

        var oTable;
        oTable = $('#table_table').dataTable();

        $('#table_id_select').change( function() {
            oTable.fnFilter( $(this).val() );
        });
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



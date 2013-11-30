<script type="text/javascript">
    $(document).ready(function(){
        $('#table_id').dataTable({
            "bSort":true,
            //need to make the scanning totals column desc by default
            "aaSortingFixed":[[3, 'desc']],
            "bFilter":true,
            "aoColumns": [{ "bSearchable": true, "bVisible": false }, null, null, null, null]
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

<div id = "main">

    <h2><?php echo $title; ?></h2>

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
            <th>Event</th>
            <th>QR Code</th>
            <th>Name</th>
            <th>Total Scans</th>
            <th>Admin</th>

        </tr>
        </thead>
        <tbody>

        <?php foreach ($scans as $scan): ?>

            <tr>
               <td><?php echo $scan->Event_ID ?></td>
               <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
               <td><?php echo $scan->Participant_FName." ".$scan->Participant_LName ?></td>
               <td><?php echo $scan->Number_of_Scans ?></td>
               <td><a href="<?php echo site_url('admin/scan_view/'.$scan->Participant_ID)?>" id="view">View Each Player's Scan</a> / <a href="<?php echo site_url('admin/scanned_by/'.$scan->QRCode)?>" id="view">View Who Scanned Player</a></td>
             </tr>

        <?php endforeach ?>

        </tbody>
    </table>
</div>


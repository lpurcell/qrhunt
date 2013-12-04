<script type="text/javascript">
    $(document).ready(function(){
        $('#table_id').dataTable({
            "bSort":true,
            //need to make the scanning totals column desc by default
            "aaSortingFixed":[[3, 'desc']],
            "bFilter":true,
            "aoColumns": [{ "bSearchable": true, "bVisible": false }, null, null, null, null, null, null, null, null]
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
    <div class="viewpart">
                <a href= "javascript:window.location.href='<?php echo site_url('admin/register/create')?>'" id="view">Register a New Participant</a>
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
                        <th>QRCode</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Misc 1</th>
                        <th>Misc 2</th>
                        <th>Misc 3</th>
                        <th>Admin</th>
                     </tr>
                </thead>
                <tbody>

                <?php foreach ($participant as $participant_item): ?>
                    <tr>
                        <td><?php echo $participant_item->Event_ID ?></td>
                        <td><a href="<?php echo site_url('participant/'.$participant_item->QRCode)?>"  id="view"><?php echo $participant_item->QRCode ?></a></td>
                        <td><?php echo $participant_item->Participant_LName ?></td>
                        <td><?php echo $participant_item->Participant_FName ?></td>
                        <td><?php echo $participant_item->Participant_Email ?></td>
                        <td><?php
                                if ($participant_item->MISC1 === "" || $participant_item->MISC1 === null || $participant_item->MISC1 === 0){
                                    echo "not provided";
                                }else {
                                    echo $participant_item->MISC1;
                                }
                            ?>
                        </td>

                        <td><?php
                            if ($participant_item->MISC2 === "" || $participant_item->MISC2 === null || $participant_item->MISC2 === 0){
                                echo "not provided";
                            }else {
                                echo $participant_item->MISC2;
                            }
                            ?>
                        </td>

                        <td><?php
                            if ($participant_item->MISC3 === "" || $participant_item->MISC3 === null || $participant_item->MISC3 === 0){
                                echo "not provided";
                            }else {
                                echo $participant_item->MISC3;
                            }
                            ?>
                        </td>

                       <td><a href="javascript:window.location.href='<?php echo site_url("admin/participant_edit/".$participant_item->Participant_ID)?>'" id="view">Edit</a> / <a href="javascript:window.location.href='<?php echo site_url("admin/participant_delete/".$participant_item->Participant_ID)?>'" id="view">Delete</a></td>

                    </tr>
                <?php endforeach ?>

                </tbody>
                </table>
                </div></div>

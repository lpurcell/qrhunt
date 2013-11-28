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
        <th>QR Code</th>
        <th>Name</th>
        <th>Event Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Admin</th>
    </tr>
    </thead>
    <tbody>

    <?php
    echo '<tr>';
    foreach ($scan_info as $info):

        echo '<td>'.$info->Event_ID.'</td>';
        echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';
            echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';


            foreach ($scans as $scan):
                if($info->Participant_ID == $scan->Participant_ID){
                    echo '<td>'.$scan->Date.'</td>';
                    echo '<td>'.$scan->Time.'</td>';
                    echo '<td>'."edit/delete".'</td>';
                }
                endforeach;

    echo '</tr>';
    endforeach ?>
    </tbody>
</table>



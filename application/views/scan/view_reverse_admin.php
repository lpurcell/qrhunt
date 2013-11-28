<?php

    echo '<h2>'.$title.'</h2>';

?>

<table id="table_id" class="display">

    <thead>
    <tr>
        <th>QR Code</th>
        <th>Name</th>
    </tr>
    </thead>
    <tbody>

    <?php
    echo '<tr>';
    foreach ($scan_info as $info):

            echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';
            echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';

    echo '</tr>';
    endforeach ?>
    </tbody>
</table>


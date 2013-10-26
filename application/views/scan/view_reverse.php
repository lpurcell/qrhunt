<?php
    if($url_id == get_cookie('qrcode')){?>
        <h2>Players Who Scanned Your QR Code</h2>
        <a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back</a>
    <?php }else{
        echo '<h2>'.$title.'</h2>';
    }
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

       if ($info->QRCode == get_cookie('qrcode')){ //if user clicks their own qrcode in the table, it will take them to their profile
            echo '<td><a href="'.site_url('participant_edit/'.get_cookie('participant_id')).'"  id="view">'.$info->QRCode.'</a></td>';
       }else{
            echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';
       }

        echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
        echo '</tr>';
    endforeach ?>
    </tbody>
</table>


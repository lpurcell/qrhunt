<div id="main">

    <?php if($url_id == get_cookie('qrcode')){?>
        <h2>Participants Who Have Scanned You</h2>
    <?php }else{
        echo '<h2>'.$title.'</h2>';
    }

    if (get_cookie('participant_id')){ ?>
        <br/>
        <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('participant/'.get_cookie('qrcode'))?>">Back</a></li>
            </ul>
        </div>
        <br/>
    <?php } ?>

    <table id="table_id" class="display">

        <thead>
        <tr>
            <th>QR Code</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Event Name</th>
            <th>Points</th>
            <th>Date</th>
            <th>Time</th>
            <th>Admin</th>
        </tr>
        </thead>
        <tbody>

        <?php
        echo '<tr>';
            foreach ($scan_info as $info):
                echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';

                    foreach ($scans as $scan_item):
                        if($scan_item->Participant_ID == $info->Participant_ID){
                            echo '<td>'.$info->Participant_LName.'</td>';
                            echo '<td>'.$info->Participant_FName.'</td>';
                            if ($scan_item->Type == "SCA"){
                                echo '<td>Scavenger Hunt</td>';
                            }else if($scan_item->Type == "PAR"){
                                echo '<td>Organization</td>';
                            }else{
                                echo '<td>Participant</td>';
                            }
                            echo '<td>'.$scan_item->Point.'</td>';
                            echo '<td>'.$scan_item->Date.'</td>';
                            echo '<td>'.$scan_item->Time.'</td>';
                        }
                    endforeach;
                ?>

                <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_edit/".$info->Participant_ID)."/".$lookupQRCode?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$info->Participant_ID."/".$info->QRCode)?>'" class="editor_remove">Delete</a></td>

        <?php echo '</tr>';

        endforeach
        ?>
        </tbody>
    </table>
</div>
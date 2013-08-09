<div id="main">
    <?php if($url_id == get_cookie('participant_id')){?>
        <h2>Your Scans</h2>

    <?php }else {
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
            <th>Scan Count</th>
            <th>QR Code Scanned</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Date</th>
            <th>Time</th>
            <!--if cookie is not set, show the admin functions-->
            <?php if (! get_cookie('participant_id')){
            echo "<th>Admin</th>";
            }
            ?>
         </tr>
    </thead>

    <tbody>

        <?php
        $count = 1;

        foreach ($participant as $participant_item):

            echo '<tr>';
            echo '<td>'.$count.'</td>';
            echo '<td><a href="'. site_url('participant/'.$participant_item->QR_Scanned).'"  id="view">'.$participant_item->QR_Scanned.'</a></td>';

            foreach ($participant_info as $info):
                if($participant_item->QR_Scanned == $info->QRCode){
                    echo '<td>'.$info->Participant_LName.'</td>';
                    echo '<td>'.$info->Participant_FName.'</td>';
                }
            endforeach;


            echo '<td>'.$participant_item->Date.'</td>';
            echo '<td>'.$participant_item->Time.'</td>'; ?>
            <?php if (!get_cookie('participant_id')){?>
            <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_edit/".$participant_item->Participant_ID)."/".$participant_item->QR_Scanned?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$participant_item->Participant_ID."/".$participant_item->QR_Scanned)?>'" class="editor_remove">Delete</a></td>
            <?php }
            echo '</tr>';

            $count += 1;

        endforeach
        ?>
    </tbody>

    </table>

</div>
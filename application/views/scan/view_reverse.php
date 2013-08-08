<div id="main">

    <h2><?php echo $title ?></h2>

    <?php if (get_cookie('participant_id')){ ?>
        <a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back</a>
    <?php } ?>
    <table id="table_id" class="display">

        <thead>
        <tr>
            <th>QR Code</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Event Name</th>
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
            echo '<tr>';
            foreach ($scan_info as $info):
            echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';

            foreach ($scans as $scan_item):
                if($scan_item->Participant_ID == $info->Participant_ID){
                    echo '<td>'.$info->Participant_LName.'</td>';
                    echo '<td>'.$info->Participant_FName.'</td>';
                }
            endforeach;

            foreach ($events as $event):
                if ($event->Event_ID == $scan_item->Event_ID){
                    echo '<td>'.$event->Event_Name.'</td>';
                }
            endforeach;

                echo '<td>'.$scan_item->Date.'</td>';
                echo '<td>'.$scan_item->Time.'</td>'; ?>

            <?php if (!get_cookie('participant_id')){?>
            <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_edit/".$info->Participant_ID)."/".$info->QRCode?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$info->Participant_ID."/".$info->QRCode)?>'" class="editor_remove">Delete</a></td>
        <?php }
            echo '</tr>';



        endforeach
        ?>
        </tbody>
    </table>
</div>
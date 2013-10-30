<div id="main">

   <?php if (get_cookie('participant_id')){ ?>
        <h2>Your Points</h2>
        <a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back</a>
    <?php }else{
            echo "<h2>$title</h2>";
           }
    ?>
<table id="table_id" class="display">

    <thead>
    <tr>
        <th>QR Code Scanned</th>
        <th>Name</th>
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
        foreach ($participant as $participant_item):

             if ($participant_item->QR_Scanned != get_cookie('qrcode')){
                //skip the user's own record that was created from the initial scan that is in the scan table
                //the code below is for if user clicks their own qrcode in the table, it will take them to their profile
                //echo '<td><a href="'.site_url('participant_edit/'.get_cookie('participant_id')).'"  id="view">'.$participant_item->QR_Scanned.'</a></td>';
                 echo '<td><a href="'. site_url('participant/'.$participant_item->QR_Scanned).'"  id="view">'.$participant_item->QR_Scanned.'</a></td>';

                foreach ($participant_info as $info):
                    if($participant_item->QR_Scanned == $info->QRCode){
                         echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
                    }

               endforeach;

                if (!get_cookie('participant_id')){?>
                    <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_edit/".$participant_item->Participant_ID)."/".$participant_item->QR_Scanned?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$participant_item->Participant_ID."/".$participant_item->QR_Scanned)?>'" class="editor_remove">Delete</a></td>
                <?php }

        echo '</tr>';
         }
         endforeach;
    ?>
    </tbody>
</table>
</div>


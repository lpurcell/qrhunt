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
            <th>Date</th>
            <th>Time</th>
            <th>Admin</th>
        </tr>
        </thead>
        <tbody>

        <?php
        echo '<tr>';
        foreach ($participant as $participant_item):

                echo '<td><a href="'. site_url('participant/'.$participant_item->QR_Scanned).'"  id="view">'.$participant_item->QR_Scanned.'</a></td>';

                foreach ($participant_info as $info):
                    if($participant_item->QR_Scanned == $info->QRCode){
                        echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
                    }

                endforeach;
                echo '<td>'. $participant_item->Date.'</td>';
                echo '<td>'. $participant_item->Time.'</td>';
                echo '<td><a href="'.site_url('admin/scan_edit/'.$participant_id.'/'.$participant_item->QR_Scanned).'" id="view">Edit</a> / <a href="'.site_url('admin/scan_delete/'.$participant_id.'/'.$participant_item->QR_Scanned).'" id="view">Delete</a></td>';

            echo '</tr>';

        endforeach;
        ?>
        </tbody>
    </table>
</div>


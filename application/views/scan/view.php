<div id="main">
    <?php
    if (get_cookie('participant_id')){ ?>
        <br/>
        <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('participant/'.get_cookie('qrcode'))?>">Back</a></li>
            </ul>
        </div>
        <br/>
    <?php
    }
    if($url_id == get_cookie('participant_id')){?>
        <h2>QR Codes You Have Scanned</h2>

    <?php }else {
    echo '<h2>'.$title.'</h2>';
    } ?>

    <table id="table_id" class="display">

    <thead>
        <tr>
            <th>QR Code Scanned</th>
            <th>Name</th>
            <th>Points</th>
        </tr>
    </thead>

    <tbody>

        <?php


        foreach ($participant as $participant_item):

            echo '<tr>';
                echo '<td><a href="'. site_url('participant/'.$participant_item->QR_Scanned).'"  id="view">'.$participant_item->QR_Scanned.'</a></td>';

                foreach ($participant_info as $info):
                    if($participant_item->QR_Scanned == $info->QRCode){
                        echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
                    }
                endforeach;
                echo '<td>'.$participant_item->Point.'</td>';
            echo '</tr>';



        endforeach
        ?>
    </tbody>

    </table>

</div>
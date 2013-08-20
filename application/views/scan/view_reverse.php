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
        if($url_id == get_cookie('qrcode')){?>
            <h2>Participants Who Have Scanned You</h2>
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
                echo '<td><a href="'. site_url('participant/'.$info->QRCode).'"  id="view">'.$info->QRCode.'</a></td>';
                echo '<td>'.$info->Participant_FName." ".$info->Participant_LName.'</td>';
            echo '</tr>';
            endforeach ?>
        </tbody>
    </table>
</div>
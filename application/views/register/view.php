<?php

    foreach ($participant as $participant_item):
        if ($participant_item->QRCode == get_cookie('qrcode')){ ?>
            <h2>Your Profile Page</h2><br/>
            <div class="menu">
                <ul>
                    <li><a href="<?php echo site_url('scan_view/'.$participant_item->Participant_ID)?>">See Your Points</a></li>
                    <li><a href="<?php echo site_url('scan/totals')?>">See Game Points</a></li>
                    <li><a href="<?php echo site_url('scanned_by/'.$participant_item->QRCode)?>">Your QRCode Scans</a></li>
                </ul>
            </div>
            <br/>
        <?php }

        if ($participant_item->Type == "PAR") {
        ?>
            <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
        <?php
        }else{
        ?>
            <img src= "<?= base_url();?>assets/images/griffonResize.jpg">
        <?php
            }
        ?>
        <h2><?php echo $participant_item->QRCode?></h2>

            <p><?php echo $participant_item->Participant_FName. " " . $participant_item->Participant_LName ?></p>
            <p><?php
                if ($participant_item->Group === "" || $participant_item->Group == null){
                    echo "";
                }else{
                    echo $participant_item->Group;
                }
                ?></p>
            <p>
                <?php
                if ($participant_item->Major === "" || $participant_item->Major == null){
                    echo "";
                }else {
                    echo $participant_item->Major;
                }
                ?>
            </p>


<?php
    endforeach
?>
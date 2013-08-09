<?php

    foreach ($participant as $participant_item):
        if ($participant_item->QRCode == get_cookie('qrcode')){ ?>
            <h2>Your Profile Page</h2>
            <a href="<?php echo site_url('scan_view/'.$participant_item->Participant_ID)?>">See Your Points</a>
            <a href="<?php echo site_url('scan/totals')?>">See Game Points</a>
            <a href="<?php echo site_url('scanned_by/'.$participant_item->QRCode)?>">Your QRCode Scans</a>
        <?php }

        echo '<h2>'.$participant_item->QRCode.'</h2>';
            if ($participant_item->Participant_Picture === "0" || $participant_item->Participant_Picture === "" || $participant_item->Participant_Picture === null){
        ?>
            <img src="<?php echo base_url(); ?>assets/images/avatar.jpg">
        <?php
            }else{
        ?>
            <img src= "<?= base_url();?>uploads/<?= $participant_item->Participant_Picture?>">

        <?php
            }
        ?>

        <ul>
            <li>Name: <?php echo $participant_item->Participant_FName. " " . $participant_item->Participant_LName ?></li>
            <li>Email: <?php echo $participant_item->Participant_Email ?></li>
            <li>Website:
                <?php
                if ($participant_item->Participant_Website === ""){
                    echo "not provided";
                }else {
                    echo $participant_item->Participant_Website;
                }
                ?>
            </li>
        </ul>

<?php
    endforeach
?>
<?php
 if (get_cookie('participant_id')){ ?>
   <ul>
        <li><a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back to Profile</a></li>
        <li><a href="<?php echo site_url('scanned_by/'.get_cookie('qrcode'))?>">See Who Scanned You</a></li>
        <li><a href="<?php echo site_url('scan/scanned_most')?>">See Most Scanned</a></li>
        <li><a href="<?php echo site_url('scan/totals')?>">See Game Points</a></li>
   </ul>
<?php }

    foreach ($participant as $participant_item):
        echo '<h2>'.$participant_item->QRCode.'</h2>';
            if ($participant_item->Participant_Picture === "0" || $participant_item->Participant_Picture === ""){
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
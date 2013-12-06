<?php
 if (get_cookie('participant_id')){ ?>
   <div class="menu">
     <ul>
        <li><a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back to Profile</a></li>
        <li><a href="<?php echo site_url('scanned_by/'.get_cookie('qrcode'))?>">See Who Scanned You</a></li>
        <li><a href="<?php echo site_url('scan/scanned_most')?>">See Most Scanned</a></li>
        <li><a href="<?php echo site_url('scan/totals')?>">See Game Points</a></li>
   </ul>
   </div>


<div class="viewpart">
<?php }

    foreach ($participant as $participant_item):
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
            <li><h4>Name:</h4> <?php echo $participant_item->Participant_FName. " " . $participant_item->Participant_LName ?></li>
            <li><h4>Email:</h4> <?php echo $participant_item->Participant_Email ?></li>
            <li><h4>Misc 1:</h4>
                <?php
                if ($participant_item->MISC1 === "" || $participant_item->MISC1 === null || $participant_item->MISC1 === 0){
                    echo "not provided";
                }else {
                    echo $participant_item->MISC1;
                }
                ?>
            </li>

            <li><h4>Misc 2:</h4>
                <?php
                if ($participant_item->MISC2 === "" || $participant_item->MISC2 === null || $participant_item->MISC2 === 0){
                    echo "not provided";
                }else {
                    echo $participant_item->MISC2;
                }
                ?>
            </li>

            <li><h4>Misc 3:</h4>
                <?php
                if ($participant_item->MISC3 === "" || $participant_item->MISC3 === null || $participant_item->MISC3 === 0){
                    echo "not provided";
                }else {
                    echo $participant_item->MISC3;
                }
                ?>
            </li>
        </ul>
</div>
<?php
    endforeach
?>
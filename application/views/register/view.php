<?php

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
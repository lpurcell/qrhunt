<?php
    foreach ($participant as $participant_item): ?>
        <div id = "main">
            <h2>QRCode: <?php echo $participant_item->QRCode ?>
                <p><?php
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

                    <?php echo $participant_item->Participant_FName ?>
                    <?php echo $participant_item->Participant_LName ?>
                </p>
            </h2>

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
        <br/>
<?php endforeach ?>


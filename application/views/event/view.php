<?php
foreach ($event as $event_item):
    echo '<h2>'.$event_item->Event_Name.'</h2>';
    if ($event_item->Event_Logo === "0" || $event_item->Event_Logo === "" || $event_item->Event_Logo === null){
        ?>
        <img src="<?php echo base_url(); ?>assets/images/QRHuntLogo5.jpg" height="100" width="200">
    <?php
    }else{
        ?>
        <img src= "<?= base_url();?>assets/images/<?= $event_item->Event_Logo?>" height="100" width="200">

    <?php
    }
    ?>

    <ul>
        <li>Email: <?php echo $event_item->Event_Email ?></li>
        <li>Location:
            <?php
            if ($event_item->Event_Location === ""){
                echo "not provided";
            }else {
                echo $event_item->Event_Location;
            }
            ?>
        </li>
    </ul>

<?php
endforeach
?>
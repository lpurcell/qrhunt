<?php
foreach ($event as $event_item):
    echo '<h2>'.$event_item->Event_Name.'</h2>';
    if ($event_item->Event_Logo === "0" || $event_item->Event_Logo === ""){
        ?>
        <img src="<?php echo base_url(); ?>assets/images/default_logo.jpg">
    <?php
    }else{
        ?>
        <img src= "<?= base_url();?>assets/images/<?= $event_item->Event_Logo?>">

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
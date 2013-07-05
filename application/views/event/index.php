<?php
foreach ($event as $event_item): ?>
    <div id = "main">
    <h2>Event Name: <?php echo $event_item->Event_Name ?>
        <p><?php
            if ($event_item->Event_Logo === "0" || $event_item->Event_Logo === ""){
                ?>
                <img src="<?php echo base_url(); ?>assets/images/default_logo.jpg ?>">
            <?php
            }else{
                ?>
                <img src= "<?= base_url();?>assets/images/<?= $event_item->Event_Logo?>">
            <?php
            }
            ?>

            <?php echo $event_item->Event_Name ?>
        </p>
    </h2>

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
    <br/>
<?php endforeach ?>
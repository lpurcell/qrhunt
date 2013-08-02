<div id = "main">

    <a href= "" onclick="javascript:window.location.href='<?php echo site_url('event/create')?>'" class="editor_create">Create a New Event</a>

    <table id="table_id" class="display">

    <thead>
    <tr>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Event Location</th>
        <th>Event Coordinator</th>
        <th>Email</th>
        <th>Event Logo</th>
        <?php if (!get_cookie('participant_id')){ ?>
        <th>Admin</th>
        <?php
        }
        ?>
     </tr>
    </thead>
    <tbody>
        <?php $datestring = '%m-%d-%Y'; ?>
        <?php foreach ($event as $event_item): ?>
            <tr>
                <td><a href="<?php echo site_url('event/'.$event_item->Event_ID)?>"  id="view"><?php echo $event_item->Event_Name ?></a></td>
                <td><?php echo mdate($datestring, strtotime($event_item->Event_Date)); ?></td>
                <td><?php echo $event_item->Event_Location ?></td>
                <td><?php echo $event_item->Event_Coordinator ?></td>
                <td><?php echo $event_item->Event_Email ?></td>
                <td><?php
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
                </td>
                <?php if (!get_cookie('participant_id')){ ?>
                <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("event_edit/".$event_item->Event_ID)?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("event_delete/".$event_item->Event_ID)?>'" class="editor_remove">Delete</a></td>
                <?php
                }
                ?>
            </tr>
        <?php endforeach ?>
    </tbody>

    </table>

</div>
<div id = "main">

    <h2><?php echo $title; ?></h2>
<?php if (get_cookie('participant_id')){ ?>
    <a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back</a>
<?php } ?>
<table id="table_id" class="display">

    <thead>
    <tr>
        <th>QR Code</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Scanned Total</th>
        <!-- if a cookie is set, they will not see the admin functions-->
        <?php if (!get_cookie('participant_id')){
            echo "<th>Admin</th>";
        } ?>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($scans as $scan): ?>

        <tr>
            <?php
            if ($scan->QRCode == get_cookie('qrcode')){ //if user clicks their own qrcode in the table, it will take them to their profile?>
                <td><a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>"  id="view"><?php echo $scan->QRCode ?></a></td>
            <?php }else{ ?>
                <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
            <?php } ?>
            <td><?php echo $scan->Participant_LName ?></td>
            <td><?php echo $scan->Participant_FName ?></td>
            <td><?php echo $scan->Number_of_Scans ?></td>
            <?php if (!get_cookie('participant_id')){ ?>
                <td><a href="<?php echo site_url('scan_view/'.$scan->Participant_ID)?>" id="view">View Each Scan</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete_all/".$scan->Participant_ID)?>'" class="editor_remove">Delete All Scans</a></td>
            <?php } ?>
        </tr>

    <?php endforeach ?>

    </tbody>
</table>
</div>
<div id = "main">

    <h2><?php echo $title; ?></h2>
    <?php if (get_cookie('participant_id')){ ?>
        <a href="<?php echo site_url('participant_edit/'.get_cookie('participant_id'))?>">Back</a>
    <?php } ?>
    <table id="table_id" class="display">

        <thead>
        <tr>
            <th>QR Code</th>
            <th>Name</th>
            <th>Total Scans</th>
            <th>Admin</th>

        </tr>
        </thead>
        <tbody>

        <?php foreach ($scans as $scan): ?>

            <tr>
               <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
               <td><?php echo $scan->Participant_FName." ".$scan->Participant_LName ?></td>
               <td><?php echo $scan->Number_of_Scans ?></td>
               <td><a href="<?php echo site_url('scan_view/'.$scan->Participant_ID)?>" id="view">View Each Player's Scan</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("admin/scanned_by/".$scan->QRCode)?>'" class="editor_remove">View Who Scanned Player</a></td>
             </tr>

        <?php endforeach ?>

        </tbody>
    </table>
</div>
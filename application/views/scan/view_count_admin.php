<div id = "main">

    <h2><?php echo $title; ?></h2>

    <?php if (get_cookie('participant_id')){ ?>
        <br/>
        <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('participant/'.get_cookie('qrcode'))?>">Back</a></li>
            </ul>
        </div>
        <br/>
    <?php } ?>


    <table id="table_id" class="display">
        <?php
        $tmp = array();
        foreach ($scans as $scan):
            $row = $scan->Type;
            if (!in_array($row,$tmp)) array_push($tmp,$row);
        endforeach;

        ?>
        <p>Filter by Event:
            <select id="table_id_select">
                <option></option>
                <?php foreach ($event as $event_item): ?>
                    <?php foreach ($tmp as $k => $v): ?>
                        <?php if ($v == $event_item->Type) {  echo '<option value='.$v .'>'.$event_item->Event_Name.'</option>' ;} ?>
                    <?php endforeach ?>
                <?php endforeach ?>
                <option>0</option>
            </select>
        </p>

        <thead>
        <tr>
            <th>Event</th>
            <th>QR Code</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Total Scans</th>
            <th>Admin</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($scans as $scan): ?>

            <tr>
                <td><?php echo $scan->Type ?></td>
                <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
                <td><?php echo $scan->Participant_LName ?></td>
                <td><?php echo $scan->Participant_FName ?></td>
                <td><?php echo $scan->Number_of_Scans ?></td>
                <td><a href="<?php echo site_url('admin/scan_view/'.$scan->Participant_ID)?>" id="view">View Each Scan</a> / <a href="<?php echo site_url("admin/scanned_by/".$scan->QRCode)?>" id="view">View Reverse</a></td>
            </tr>

        <?php endforeach ?>

        </tbody>
    </table>
</div>
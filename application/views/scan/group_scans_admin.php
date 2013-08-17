<div id = "main">

    <?php if (get_cookie('participant_id')){ ?>
        <br/>
        <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('participant/'.get_cookie('qrcode'))?>">Back</a></li>
            </ul>
        </div>
        <br/>
    <?php } ;?>

    <h2><?php echo $title; ?></h2>

    <table id="table_id" class="display">
        <!--<p>Filter by Event:
           <select id="table_id_select">
               <option></option>
               <option value="123">Participant</option>
               <option value="456">Organization</option>
               <option value="789">Scavenger Hunt</option>
           </select>
       </p>-->

        <thead>
        <tr>
            <th>Participant QRCode</th>
            <th>Name</th>
            <th>QR Scanned</th>
            <th>Type</th>
            <th>Points</th>
            <th>Date</th>
            <th>Time</th>
            <th>Admin</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($scans as $scan): ?>
            <tr>
                <th><?php echo $scan->QRCode?></th>
                <th><?php echo $scan->Participant_FName." ".$scan->Participant_LName ?></th>
                <th><?php echo $scan->QR_Scanned?></th>
                <td><?php echo $scan->Type ?></td>
                <td><?php echo $scan->Point ?></td>
                <td><?php echo $scan->Date ?></td>
                <td><?php echo $scan->Time ?></td>
                <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$scan->Participant_ID."/".$scan->QR_Scanned)?>'" class="editor_remove">Delete</a></td>
            </tr>
        <?php endforeach ?>


        </tbody>
    </table>
</div>
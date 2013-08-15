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

        <p>Filter by Type:
            <select id="table_id_select">
                <option></option>
                <option value="123">Participant</option>
                <option value="456">Organization</option>
                <option value="789">Scavenger Hunt</option>

            </select>
        </p>

        <thead>
        <tr>
            <th>Type</th>
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
                <?php if ($scan->Type == "PAR"){?>
                    <td>123</td>
                <?php }else if ($scan->Type == "ORG"){?>
                    <td>456</td>
                <?php } else { ?>
                    <td>789</td>
                <?php } ?>
                <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
                <td><?php echo $scan->Participant_LName ?></td>
                <td><?php echo $scan->Participant_FName ?></td>
                <td><?php echo $scan->Number_of_Scans ?></td>
                <td><a href="<?php echo site_url('admin/scan_view/'.$scan->Participant_ID)?>" id="view">View Each</a> / <a href="<?php echo site_url("admin/scanned_by/".$scan->QRCode)?>" id="view">View Reverse</a></td>
            </tr>

        <?php endforeach ?>

        </tbody>
    </table>
</div>
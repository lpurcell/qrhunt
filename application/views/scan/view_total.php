<div id = "main">

    <?php if (get_cookie('participant_id')){ ?>
        <br/>
        <div class="menu">
            <ul>
                <li><a href="<?php echo site_url('participant/'.get_cookie('qrcode'))?>">Back</a></li>
            </ul>
        </div>
        <br/>
    <?php } ?>

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
                <th>QR Code</th>
                <th>Name</th>
                <th>Points</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($scans as $scan): ?>

                <tr>
                    <td><a href="<?php echo site_url('participant/'.$scan->QRCode)?>"  id="view"><?php echo $scan->QRCode ?></a></td>
                    <td><?php echo $scan->Participant_FName." ".$scan->Participant_LName ?></td>
                    <td><?php echo $scan->Points ?></td>
                 </tr>

            <?php endforeach ?>

        </tbody>
    </table>
</div>
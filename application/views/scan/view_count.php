<div id = "main">

    <h2><?php echo $title; ?></h2>

    <table id="table_id" class="display">

        <thead>
        <tr>
            <th>Participant ID</th>
            <th>Total Scans</th>
            <th>Admin</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($scans as $scan): ?>

        <tr>
            <!--TO DO link to view participant profile-->
            <td><a href="" onclick="return ViewParticipant();" id="view_participant"><?php echo $scan->Participant_ID ?></a></td>
            <td><?php echo $scan->Number_of_Scans ?></td>
            <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan/".$scan->Participant_ID)?>'" class="editor_edit">View Each Scan</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete_all/".$scan->Participant_ID)?>'" class="editor_remove">Delete All Scans</a></td>
        </tr>

        <?php endforeach ?>

        </tbody>
    </table>
</div>
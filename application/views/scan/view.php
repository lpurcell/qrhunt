<div id="main">
<table id="table_id" class="display">

    <h2><? echo $title ?></h2>

    <thead>
    <tr>
        <th>Scan Count</th>
        <th>QR Code Scanned</th>
        <th>Date</th>
        <th>Time</th>
        <!--if cookie is not set, show the admin functions-->
        <?php if (empty($_COOKIE)){
        echo "<th>Admin</th>";
        }
        ?>

     </tr>
    </thead>
    <tbody>

    <?php
    $count = 1;

    foreach ($participant as $participant_item):

        echo '<tr>';
        echo '<td>'.$count.'</td>';
        echo '<td>'.$participant_item->QR_Scanned.'</td>';
        echo '<td>'.$participant_item->Date.'</td>';
        echo '<td>'.$participant_item->Time.'</td>'; ?>
        <?php if (empty($_COOKIE)){?>
        <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_edit/".$participant_item->Participant_ID)."/".$participant_item->QR_Scanned?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("scan_delete/".$participant_item->Participant_ID."/".$participant_item->QR_Scanned)?>'" class="editor_remove">Delete</a></td>
        <?php }
        echo '</tr>';

        $count += 1;

    endforeach
    ?>
    </tbody>
</table>
</div>
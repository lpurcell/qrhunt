<div id="main">
<table id="table_id" class="display">

    <h2><? echo $title ?></h2>

    <thead>
    <tr>
        <th>Scan Count</th>
        <th>QR Code Scanned</th>
        <th>Date</th>
        <th>Time</th>
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
        echo '<td>'.$participant_item->Time.'</td>';
        echo '</tr>';

        $count += 1;

    endforeach
    ?>
    </tbody>
</table>
</div>
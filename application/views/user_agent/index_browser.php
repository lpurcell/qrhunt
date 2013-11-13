
<div id = "main">
    <h2><?php echo $title; ?></h2>

    <table id="table_id" class="display">

        <thead>
        <tr>
            <th>Browser Type</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach($agents as $agent):
            echo "<tr>";
            echo "<td>".$agent->Agent."</td>";
            echo "<td>".$agent->Total."</td>";
            echo "</tr>";

        endforeach;
        ?>

        </tbody>
    </table>
</div>

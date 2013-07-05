<?php
foreach ($organization as $organization_item): ?>
    <div id = "main">
    <h2>Organization: <?php echo $organization_item->Organization_Name ?>
        <p>
            <?php echo $organization_item->Organization_Sponsor ?>
        </p>
    </h2>

    <br/>
<?php endforeach ?>
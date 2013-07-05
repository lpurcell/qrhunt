<?php
foreach ($organization as $organization_item): ?>
<ul>
        <li>Organization: <?php echo $organization_item->Organization_Name ?></li>
        <li>Sponsor:
            <?php
            if ($organization_item->Organization_Sponsor === ""){
                echo "not provided";
            }else {
                echo $organization_item->Organization_Sponsor;
            }
            ?>
        </li>
    </ul>
<?php endforeach ?>
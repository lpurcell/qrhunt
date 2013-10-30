<div id = "main">

    <a href= "" onclick="javascript:window.location.href='<?php echo site_url('organization/create')?>'" class="editor_create">Create a New Organization</a>

    <table id="table_id" class="display">

        <thead>
            <tr>
                <th>Organization Name</th>
                <th>Organization Sponsor</th>
                <?php if (! get_cookie('participant_id')){ ?>
                <th>Admin</th>
                <?php
                }
                ?>
             </tr>
        </thead>

        <tbody>

        <?php foreach ($organization as $organization_item): ?>
            <tr>
                <td><a href="<?php echo site_url('organization/'.$organization_item->Organization_ID)?>"  id="view"><?php echo $organization_item->Organization_Name ?></a></td>
                <td><?php echo $organization_item->Organization_Sponsor ?></td>
                <?php if (! get_cookie('participant_id')){ ?>
                <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("organization_edit/".$organization_item->Organization_ID)?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("organization_delete/".$organization_item->Organization_ID)?>'" class="editor_remove">Delete</a></td>
                <?php
                }
                ?>
            </tr>
        <?php endforeach ?>

        </tbody>

    </table>

</div>
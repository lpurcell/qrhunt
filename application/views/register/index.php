            <div id = "main">

                <a href= "" onclick="javascript:window.location.href='<?php echo site_url('register/create')?>'" class="editor_create">Create new record</a>
                <table id="table_id" class="display">

                <thead>
                    <tr>
                        <th>QRCode</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <?php if (! get_cookie('participant_id')){
                            echo "<th>Admin</th>";
                        }
                        ?>
                     </tr>
                </thead>
                <tbody>

                <?php foreach ($participant as $participant_item): ?>
                    <tr>
                        <td><a href="<?php echo site_url('participant/'.$participant_item->QRCode)?>"  id="view"><?php echo $participant_item->QRCode ?></a></td>
                        <td><?php echo $participant_item->Participant_LName ?></td>
                        <td><?php echo $participant_item->Participant_FName ?></td>
                        <td><?php echo $participant_item->Participant_Email ?></td>
                        <td><?php
                                if ($participant_item->MISC1 === ""){
                                    echo "not provided";
                                }else {
                                    echo $participant_item->MISC1;
                                }
                            ?>
                        </td>
                        <?php if (!get_cookie('participant_id')) { ?>
                        <td><a href="" onclick="javascript:window.location.href='<?php echo site_url("participant_edit/".$participant_item->Participant_ID)?>'" class="editor_edit">Edit</a> / <a href="" onclick="javascript:window.location.href='<?php echo site_url("participant_delete/".$participant_item->Participant_ID)?>'" class="editor_remove">Delete</a></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php endforeach ?>

                </tbody>
                </table>
                </div>


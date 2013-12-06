<?php
echo validation_errors();
echo form_open_multipart('admin/labels/labels') ?>

<h2>Create Participant Labels</h2>

<table>
<tr>
    <td><label for="Event_ID">Choose your Event:</label></td>
    <td>
        <select name="Event_ID">
            <?php foreach($event as $event_item): ?>
                <option  value="<?php echo $event_item->Event_ID; ?>"><?php echo $event_item->Event_Name; ?></option>
            <?php endforeach ?>
        </select>
    </td>
</tr>
</table>

<input type="submit" name="submit" value="Create Participant Labels" />

</form>
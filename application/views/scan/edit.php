<h2>Edit a Scan</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('scan_edit/'.$scan->Participant_ID.'/'.$scan->QR_Scanned) ?>

<label for="Participant_ID">Participant ID:</label>
<input type="input" name="Participant_ID" value="<?php echo $scan->Participant_ID ?>"/><br />

<label for="QR_Scanned">QR Scanned: </label>
<input type="input" name="QR_Scanned" value="<?php echo $scan->QR_Scanned ?>"/><br />

<select name="Type">
    <?php foreach($event as $event_item): ?>
        <option  value="<?php echo $event_item->Type; ?>" <?php if ($event_item->Type == $scan->Type){ echo "selected='selected'"; }else{ ''; } ?> ><?php echo $event_item->Event_Name; ?></option>
    <?php endforeach ?>
</select><br/>

<label for="Time">Time: </label>
<input type="input" name="Time" value="<?php echo $scan->Time ?>"/><br />
<p>must be in HH:MM:SS format</p>

<label for="Date">Date: </label>
<input type="input" id="datepicker" name="Date" value="<?php echo $scan->Date ?>"/><br />

<input type="submit" name="submit" value="Edit Scan" /><br />
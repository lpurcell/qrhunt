<h2>Edit a Scan</h2>
<?php echo validation_errors(); ?>

<?php echo form_open('scan_edit/'.$scan->Participant_ID.'/'.$scan->QR_Scanned) ?>

<label for="Participant_ID">Participant ID:</label>
<input type="input" name="Participant_ID" value="<?php echo $scan->Participant_ID ?>"/><br />

<label for="QR_Scanned">QR Scanned: </label>
<input type="input" name="QR_Scanned" value="<?php echo $scan->QR_Scanned ?>"/><br />

<label for="Type">QR Scanned Type: </label>
<select name="Type">
    <option value="PAR" <?php if ($scan->Type == "PAR") {echo "selected='selected'";}?> >Participant</option>
    <option value="LEA" <?php if ($scan->Type == "LEA") {echo "selected='selected'";}?> >Leader</option>
    <option value="ORG" <?php if ($scan->Type == "ORG") {echo "selected='selected'";}?> >Organization</option>
    <option value="SCA" <?php if ($scan->Type == "SCA") {echo "selected='selected'";}?> >Scavenger Hunt</option>
</select><br/>

<label for="Time">Time: </label>
<input type="input" name="Time" value="<?php echo $scan->Time ?>"/><br />
<p>must be in HH:MM:SS format</p>

<label for="Date">Date: </label>
<input type="input" id="datepicker" name="Date" value="<?php echo $scan->Date ?>"/><br />

<input type="submit" name="submit" value="Edit Scan" /><br />
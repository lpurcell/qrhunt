<?php
class Scan_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('form', 'html', 'file', 'url', 'date'));
    }

    public function scan($participant_scanning, $participant_scanned)
    {
        $data = array(
            'Participant_ID' => $participant_scanning,
            'QR_Scanned' => $participant_scanned,
        );

        //set the date and time
        $this->db->set('Scan_Time', 'now()', FALSE);

        //if a duplicate is attempted to be entered, the database will throw an error, this keeps it from doing that. The duplicate data is not entered.
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $this->db->insert('scan', $data);

        $this->db->db_debug = $db_debug;
        return;
    }
}
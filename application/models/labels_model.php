<?php
/**
 * Missouri Western State University
 * User: Meagan Gates
 * Date: 10/24/13
 * Time: 4:21 PM
 */

class Labels_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_participants($event) {
        $query = $this->db->query("SELECT PARTICIPANT_ID, PARTICIPANT_FNAME, PARTICIPANT_LNAME, QRCODE FROM participant WHERE ".$event." = EVENT_ID");

        if($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return "Error";
        }
    }

    public function get_event($event) {
        $query = $this->db->query("SELECT EVENT_NAME FROM event WHERE EVENT_ID=".$event);
        return $query;
    }
}
?>
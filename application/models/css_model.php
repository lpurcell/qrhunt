<?php
class Css_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_css($Event_ID){



            $this->db->select('Event_Logo, Event_Maincolor, Event_Textcolor, Event_Headercolor, Event_Logobackground, Event_Footer, Event_Twitter');
            $this->db->from('event');
            $this->db->where('Event_ID', $Event_ID);
            return $this->db->get()->result();

    }

}
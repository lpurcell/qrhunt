<?php

class Event_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function event(){

        $data = array(
            'Organization_ID' => $this ->input->post('Organization_ID'),
            'Event_Name' => $this ->input->post('Event_Name'),
            'Event_Location' => $this->input->post('Event_Location'),
            'Event_Date' => $this->input->post('Event_Date'),
            'Event_Email' => $this->input->post('Event_Email'),
            'Event_Logo' => $this->input->post('userfile'),
            'Event_Maincolor' => $this->input->post('Event_Maincolor'),
            'Event_Textcolor' => $this->input->post('Event_Textcolor'),
            'Event_Headercolor' => $this->input->post('Event_Headercolor')
        );

        return $this->db->insert('event', $data);
    }


}
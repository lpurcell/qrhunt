<?php

class Event_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function event(){

        $data = array(
            'Organization_ID' => $this->input->post('Organization_ID'),
            'Event_Name' => $this ->input->post('Event_Name'),
            'Event_Location' => $this->input->post('Event_Location'),
            'Event_Date' => $this->input->post('Event_Date'),
            'Event_Coordinator' => $this->input->post('Event_Coordinator'),
            'Event_Email' => $this->input->post('Event_Email'),
            'Event_Logo' => $this->input->post('userfile'),
            'Event_Maincolor' => $this->input->post('Event_Maincolor'),
            'Event_Textcolor' => $this->input->post('Event_Textcolor'),
            'Event_Headercolor' => $this->input->post('Event_Headercolor')
        );

        return $this->db->insert('event', $data);
    }
    //used in edit()
    public function find_by_id($event_id){
        $this->db->select('Event_ID, Organization_ID, Event_Name, Event_Location, Event_Date, Event_Coordinator, Event_Email, Event_Logo, Event_Maincolor, Event_Textcolor, Event_Headercolor');
        $this->db->from('event');
        $this->db->where('Event_Id', $event_id);
        return $this->db->get()->row(0);
    }

    //used in registering a participant is not in the event controller
    public function event_names(){
        $this->db->select('Event_ID, Event_Name');
        $this->db->from('event');

        return $this->db->get()->result();
    }

    public function get_events($slug = FALSE){

        if($slug === FALSE){
            $this->db->select("Event_ID, Event_Name, Event_Location, Event_Date, Event_Coordinator, Event_Email, Event_Logo, Event_Maincolor, Event_Textcolor, Event_Headercolor");
            $this->db->from('event');
            //need to filter data
            //$this->db->where('')
            return $this->db->get()->result();
        }
        $this->db->select('Event_ID, Event_Name, Event_Location, Event_Date, Event_Coordinator, Event_Email, Event_Logo, Event_Maincolor, Event_Textcolor, Event_Headercolor');
        $this->db->from('event');
        $this->db->where('Event_ID', $slug);
        return $this->db->get()->result();
    }

    public function update($data){

        $this->db->where('Event_Id', $data['Event_ID']);
        $this->db->update('event', $data);
    }

    public function delete($event_id){
        $this->db->delete('event', array('Event_ID'=>$event_id));
    }

}
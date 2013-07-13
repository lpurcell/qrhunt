<?php

class Register_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    //register participants
	public function register(){

		$data = array(
            'Event_ID' => $this ->input->post('Event_ID'),
			'Participant_LName' => $this->input->post('Participant_LName'),
			'Participant_FName' => $this->input->post('Participant_FName'),
			'Participant_Email' => $this->input->post('Participant_Email'),
			'QRCode' => $this->input->post('QRCode'),
			'Participant_Website' => $this->input->post('Participant_Website'),
			'Participant_Picture' => $this->input->post('userfile')
			);

		    return $this->db->insert('participant', $data);
    }
    //view all participants or just one by QRCode in database
    public function get_participants($slug = FALSE){

        if($slug === FALSE){
            $this->db->select('Participant_ID, Participant_LName, Participant_FName, Participant_Email, Participant_Website, QRCode, Participant_Picture');
            $this->db->from('participant');
            //need to filter data
            //$this->db->where('')
            return $this->db->get()->result();
        }
        $this->db->select('Participant_LName, Participant_FName, Participant_Email, Participant_Website, QRCode, Participant_Picture');
        $this->db->from('participant');
        $this->db->where('QRCode', $slug);
        return $this->db->get()->result();
    }

    //edit function
    public function update($data){

        $this->db->where('Participant_ID', $data['Participant_ID']);
        $this->db->update('participant', $data);
    }

    //part of edit function
    public function find_by_id($participant_id){
        $this->db->select('Participant_ID, Event_ID, Participant_LName, Participant_FName, Participant_Email, Participant_Website, QRCode, Participant_Picture');
        $this->db->from('participant');
        $this->db->where('Participant_ID', $participant_id);
        return $this->db->get()->row(0);
    }

    public function delete($participant_id){
        $this->db->delete('participant', array('Participant_ID'=>$participant_id));
    }
}


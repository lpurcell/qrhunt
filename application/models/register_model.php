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
			'MISC1' => $this->input->post('MISC1'),
            'MISC2' => $this->input->post('MISC2'),
            'MISC3' => $this->input->post('MISC3'),
			'Participant_Picture' => $this->input->post('userfile')
			);

		    return $this->db->insert('participant', $data);
    }
    //view all participants or just one by QRCode in database
    public function get_participants($slug = FALSE){

        if($slug === FALSE){
            $this->db->select('Participant_ID, Participant_LName, Participant_FName, Participant_Email, MISC1, MISC2, MISC3, QRCode, Participant_Picture');
            $this->db->from('participant');
            //need to filter data
            //$this->db->where('')
            return $this->db->get()->result();
        }
        $this->db->select('Event_ID, Participant_LName, Participant_FName, Participant_Email, MISC1, MISC2, MISC3, QRCode, Participant_Picture');
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
        $this->db->select('Participant_ID, Event_ID, Participant_LName, Participant_FName, Participant_Email, MISC1, MISC2, MISC3, QRCode, Participant_Picture');
        $this->db->from('participant');
        $this->db->where('Participant_ID', $participant_id);
        return $this->db->get()->row(0);
    }

    public function delete($participant_id){
        $this->db->delete('participant', array('Participant_ID'=>$participant_id));
    }

    //get data for single scan view in view() function of scan model
    public function get_name($qr_scanned){
        $this->db->select("Participant_LName, Participant_FName, QRCode");
        $this->db->from('participant');
        $this->db->where('QRCode', $qr_scanned);

        return $this->db->get()->row();
    }

    //get qrcode, event_id, first and last name of person who is scanning in check_name() of scan
    public function participant_qrcode($participant_scanning){
        $this->db->select('Participant_ID, QRCode, Event_ID, Participant_LName, Participant_FName');
        $this->db->from('participant');
        $this->db->where('QRCode', $participant_scanning);
        return $this->db->get()->row(0);
    }

    //check the participant_id of the person scanning in insert() of scan controller
    public function check_participant_id($participant_qrcode){
        $this->db->select('Participant_Id');
        $this->db->from('participant');
        $this->db->where('QRCode', $participant_qrcode);
        $result = $this->db->get()->row(0);

        if ($result == NULL){
            return false;
        }else{
            return true;
        }
    }
    //check the event_id of person scanned in check_scan() of scan controller
    public function check_event($participant_scanned){
        $this->db->select('Event_Id');
        $this->db->from('participant');
        $this->db->where('QRCode', $participant_scanned);

        return $this->db->get()->row(0);
    }
}


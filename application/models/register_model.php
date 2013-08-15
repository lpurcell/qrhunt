<?php

class Register_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    //register participants
	public function register($point_data){

		$data = array(
            'Type' => $this ->input->post('Type'),
			'Participant_LName' => $this->input->post('Participant_LName'),
			'Participant_FName' => $this->input->post('Participant_FName'),
			'Group' => $this->input->post('Group'),
			'QRCode' => $this->input->post('QRCode'),
			'Major' => $this->input->post('Major')
            );

        $data['Point'] = $point_data;

		    return $this->db->insert('participant', $data);
    }
    //view all participants or just one by QRCode in database
    public function get_participants($slug = FALSE){

        if($slug === FALSE){
            $this->db->select('Participant_ID, Participant_LName, Participant_FName, Group, Major, QRCode');
            $this->db->from('participant');
            //need to filter data
            //$this->db->where('')
            return $this->db->get()->result();
        }
        $this->db->select('Participant_ID, Type, Participant_LName, Participant_FName, Group, Major, QRCode');
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
        $this->db->select('Participant_ID, Type, Participant_LName, Participant_FName, Group, Major, QRCode');
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

    //get qrcode, Type, first and last name of person who is scanning in check_name() of scan
    public function participant_qrcode($participant_scanning){
        $this->db->select('Participant_ID, QRCode, Type, Participant_LName, Participant_FName');
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
    //check the Type of person scanned in check_scan() of scan controller
    public function check_event($participant_scanned){
        $this->db->select('Type, Point');
        $this->db->from('participant');
        $this->db->where('QRCode', $participant_scanned);

        return $this->db->get()->row(0);
    }
}


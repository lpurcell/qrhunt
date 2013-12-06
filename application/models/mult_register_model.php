<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Meagan Gates
 * Organization: Missouri Western State University
 * Date: 10/15/13
 * Time: 2:03 PM
 */
class Mult_register_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    //register single participants
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
}
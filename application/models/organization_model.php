<?php

class Organization_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function organization(){

        $data = array(
            'Organization_Name' => $this ->input->post('Organization_Name'),
            'Organization_Sponsor' => $this->input->post('Organization_Sponsor')
        );

        return $this->db->insert('organization', $data);
    }
}
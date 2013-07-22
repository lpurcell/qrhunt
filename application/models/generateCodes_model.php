<?php

class generateCodes_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function register(){
        $data = array('QRCode' => $this->input->post('QRCode'));
    }
}


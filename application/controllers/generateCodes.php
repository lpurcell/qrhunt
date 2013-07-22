<?php
class generateCodes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('generateCodes_model');
        $this->load->helper(array('form', 'html', 'file', 'cookie'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('QRCode', 'QR Code', 'required');
    }

    public function create()
    {
        $data['title'] = 'Generate QR Codes';

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('register/generateCodes');
            $this->load->view('templates/footer');
        }else{
            $this->load->view('news/success');
        }

    }
}
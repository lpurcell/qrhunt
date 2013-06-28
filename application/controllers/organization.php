<?php
class Organization extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('organization_model');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Register Your Organization';

        $this->form_validation->set_rules('Organization_Name', 'Organization Name', 'required');
        $this->form_validation->set_rules('Organization_Sponsor', 'Sponsor Name', 'required');


        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('organization/create');
            $this->load->view('templates/footer');

        }
        else{
            $this->organization_model->organization();
            $this->load->view('news/success');
        }
    }
}		
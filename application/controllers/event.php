<?php
class Event extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->helper('url');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Register Your Event';

        $this->form_validation->set_rules('Organization_ID', 'Organization_ID', 'required');
        $this->form_validation->set_rules('Event_Name', 'Event Name:', 'required');
        $this->form_validation->set_rules('Event_Location', 'Location', 'required');
        $this->form_validation->set_rules('Event_Date', 'Date of Event:', 'required');
        $this->form_validation->set_rules('Event_Coordinator', 'Coordinator Name:', 'required');
        $this->form_validation->set_rules('Event_Email', 'Coordinator Email:', 'required');
        $this->form_validation->set_rules('Event_Logo', 'Logo for Event');
        $this->form_validation->set_rules('Event_Maincolor', 'Main Color: ');
        $this->form_validation->set_rules('Event_Textcolor', 'Text Color:');
        $this->form_validation->set_rules('Event_Headercolor', 'Header Color:');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header2', $data);
            $this->load->view('event/create');
            $this->load->view('templates/footer');

        }
        else{
            $this->event_model->event();
            $this->load->view('news/success');
        }
    }


}		
<?php
class Scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scan_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
    }

    public function create()
    {
        $data['title'] = 'Scan a QRCode';

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('scan/create');
            $this->load->view('templates/footer');

        } else {
            $this->scan_model->scan();
            $this->load->view('news/success');
        }
    }

    public function insert($participant_scanning, $participant_scanned)
    {
        //TO DO: check the data that is inserted is in the database
        //Throw an error if a person tries to scan a person more than once?

       $this->scan_model->scan($participant_scanning, $participant_scanned);
       redirect('participant/'.$participant_scanned);
    }
}
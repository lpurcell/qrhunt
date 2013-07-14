<?php
class Scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scan_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Participant_ID', 'Participant ID', 'required');
        $this->form_validation->set_rules('QR_Scanned', 'QR Scanned', 'required');
    }

    //create a scan manually
    public function create()
    {
        $data['title'] = 'Scan a QRCode';

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('scan/create');
            $this->load->view('templates/footer');

        } else {
            $this->scan_model->scan_manual();
            $this->load->view('news/success');
            //redirect to person's file
        }
    }

    //scan with mobile devices
    public function insert($participant_scanning, $participant_scanned)
    {
        //TO DO: check the data that is inserted is in the database
        //Throw an error if a person tries to scan a person more than once?

       $this->scan_model->scan($participant_scanning, $participant_scanned);
       redirect('participant/'.$participant_scanned);
    }
    //view all scans

    //view individual scans by participant_id
    public function view($slug){
        $data['participant'] = $this->scan_model->get_scans($slug);

        if(empty($data['participant'])){
            show_404();
        }
        $data['title'] = 'Scans by ' . $slug;

        $this->load->view('templates/header_tables', $data);
        $this->load->view('scan/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($participant_id, $qr_scanned){
         $scan = $this->scan_model->find_by_id($participant_id, $qr_scanned);

        $data['scan']= $scan;

        $data['title'] = 'Edit a Scan';

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header_scan', $data);
            $this->load->view('scan/edit', $data);
            $this->load->view('templates/footer');

        }else{
            $date = $this->input->post('Date');
            $time = $this->input->post('Time');

            $datetime = $date." ".$time;

            $new_datetime=date("Y-m-d H:i:s", strtotime($datetime));

            $new_data = array(
                'Participant_ID' => $this->input->post('Participant_ID'),
                'QR_Scanned' => $this ->input->post('QR_Scanned'),
                'Scan_Time' => $new_datetime
             );

            $this->scan_model->update($new_data);
            $this->load->view('news/success');
        }

    }

    public function delete($slug){
        $this->scan_model->delete($slug);
        $this->load->view('news/success');
    }
}
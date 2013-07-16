<?php
class Scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scan_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
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
        $CI =& get_instance();
        $CI->load->model('register_model');
        $data = $CI->register_model->participant_qrcode($participant_scanning);

        $scanning_qrcode = $data->QRCode;
        $scanning_eventid = $data->Event_ID;



        //if they scan their own qrcode and a cookie is not set
        if ($scanning_qrcode == $participant_scanned && get_cookie('qrcode')!= $participant_scanned){ //&& cookie is not set
            //set cookie
            $cookie = array(
              array(
              'name' => 'qrcode',
              'value' => $scanning_qrcode,
              'expire' => time()+3600,
                ),
              array(
                'name' => 'event_id',
                'value' => $scanning_eventid,
                'expire' => time()+3600,
              )
            );

            foreach($cookie as $cookies){
            $this->input->set_cookie($cookies);
            }
            $this->load->view('news/success');
        }
        //if they scan their own qrcode and a cookie is set, they will go to edit their profile
        elseif ($scanning_qrcode == $participant_scanned && get_cookie('qrcode')==$participant_scanned){//&& cookie is set
           echo  var_dump($this->input->cookie('qrcode'));
            redirect('participant_edit/'.$participant_scanning);
        }
        //if they scan someone else's code before scanning theirs
        else if ($scanning_qrcode != $participant_scanned && get_cookie('qrcode') != $scanning_qrcode) //&& cookie is not set
        {
            $this->load->view('templates/header');
            $this->load->view('news/scan_notice');
            $this->load->view('templates/footer');
        }
        //if their cookie is set and they scan someone
        else{
            $this->scan_model->scan($participant_scanning, $participant_scanned);
            redirect('participant/'.$participant_scanned);
        }
    }

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

    public function view_count(){
        $data['scans'] = $this->scan_model->view_by_count();

        $data['title'] = "Scan Totals";

        $this->load->view('templates/header_tables', $data);
        $this->load->view('scan/view_count', $data);
        $this->load->view('templates/footer');

    }

    //delete an individual scan
    public function delete($participant_id,$qr_scanned){
        $this->scan_model->delete($participant_id,$qr_scanned);
        $this->load->view('news/success');
    }

    //delete all scans made by a participant
    public function delete_all($participant_id){
        $this->scan_model->delete_all($participant_id);
        $this->load->view('news/success');
    }
}
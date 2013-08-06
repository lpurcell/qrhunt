<?php
class Scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scan_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
        $this->load->library('form_validation');


        $this->form_validation->set_rules('QR_Scanned', 'QR Scanned');
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
            $participant_scanned = $_POST['QR_Scanned'];

           redirect('scan/'.$participant_scanned);

        }
    }

    //scan with mobile devices
    public function insert($participant_scanned){

        $CI =& get_instance();
        $CI->load->model('register_model');
        $check_participant =  $CI->register_model->check_participant_id($participant_scanned); //checks if the participant_id is in the database

        //if the qrcode for participant_scanned doesn't exist
        if ($check_participant == false){
            $message['error'] = "Sorry, this QR Code does not exist.";
            $message['title'] = "Error";

            $this->load->view('templates/header', $message);
            $this->load->view('news/scan_notice',$message);
            $this->load->view('templates/footer');

         }else{

            //if they scan their own qrcode and a cookie is not set
            if (get_cookie('qrcode')!= $participant_scanned && !get_cookie('participant_id')){ //&& cookie is not set

                $this->check_name($CI, $participant_scanned);
            }

            //if they scan their own qrcode and cookie is set, view edit page
            if (get_cookie('qrcode')== $participant_scanned && get_cookie('participant_id')){

                redirect('participant_edit/'.get_cookie('participant_id'));
            }

            //if participant scanned doesn't match qrcode in cookie and participant cookie is set
            if (get_cookie('qrcode') != $participant_scanned && get_cookie('participant_id')){

                $this->check_scan($CI, $participant_scanned);
            }
        }

    }

    //checks the participant's name if there is not a cookie set/sets cookie
    public function check_name($CI, $participant_scanned){
        $data = $CI->register_model->participant_qrcode($participant_scanned);

        $scanning_participant_id = $data->Participant_ID;
        $scanning_eventid = $data->Event_ID;
        $scanning_qrcode = $data->QRCode;
        $scanning_name = $data->Participant_FName . " " . $data->Participant_LName;

        if (!isset($_POST['Yes']) && !isset($_POST['No'])){

        $message['check'] = "Are you $scanning_name?";
        $message['title'] = "Name Check";

        $this->load->view('templates/header', $message);
        $this->load->view('news/scan_check', $message);
        $this->load->view('templates/footer');

        }elseif ($this->input->post('Yes') && isset($_POST["Yes"])){//set cookie
            $cookie = array(
                array(
                    'name' => 'participant_id',
                    'value' => $scanning_participant_id,
                    'expire' => time()+3600,
                ),
                array(
                    'name' => 'event_id',
                    'value' => $scanning_eventid,
                    'expire' => time()+3600,
                ),
                array(
                    'name' => 'qrcode',
                    'value' => $scanning_qrcode,
                    'expire' => time()+3600,
                ),
                array(
                    'name' => 'participant_name',
                    'value' => $scanning_name,
                    'expire' => time()+3600,
                )
            );

            foreach($cookie as $cookies){
                $this->input->set_cookie($cookies);
            }
            $this->load->view('news/success');
        }elseif ($this->input->post('No') || isset($_POST['No'])){
            $message['error'] = "Please scan your QR Code first to start the game.";
            $message['title'] = "Error";

            $this->load->view('templates/header', $data);
            $this->load->view('news/scan_notice', $message);
            $this->load->view('templates/footer');
        }
    }

    //checks if the scan is already in the database, if not sends to model
    public function check_scan($CI, $participant_scanned){
        $participant_scanning = get_cookie('participant_id');

        $already_scanned = $CI->scan_model->check_scan($participant_scanning, $participant_scanned); //checks if the scan is already in the database
        $event_check = $CI->register_model->check_event($participant_scanned);

        //if they scanned someone and it is in the database already
        if ($already_scanned == true){
            $message['error'] = "You have already scanned this QR Code.<br/>You will receive no points for viewing their profile.";
            $message['participant_scanned'] = $participant_scanned;
            $data['title'] = "Scan Exists";

            $this->load->view('templates/header', $data);
            $this->load->view('news/notice_redirect', $message);
            $this->load->view('templates/footer');

        }
        elseif($event_check->Event_Id != get_cookie('event_id')){  //if they scanned someone who is in a different event
            $message['error'] = "Sorry, this QR Code is in a different event";

            $data['title'] = "Event Mismatch";

            $this->load->view('templates/header', $data);
            $this->load->view('news/scan_notice', $message);
            $this->load->view('templates/footer');
        }
        //if their cookie is set and they scan someone they haven't scanned before
        else{

            $this->scan_model->scan($participant_scanning, $participant_scanned);
            redirect('participant/'.$participant_scanned);
        }

    }

    //view individual scans by participant_id
    public function view($slug){
        $CI =& get_instance();
        $CI->load->model('register_model');
        $data['participant'] = $this->scan_model->get_scans($slug);
        $result = $data['participant'];
        $data['participant_info'] = array();

        if(empty($data['participant'])){
            show_404();
        }


        foreach($result as $row){
            $qr_scanned = $row->QR_Scanned;

            $result2[] = $CI->register_model->get_name($qr_scanned);

            $data['participant_info'] = $result2;

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

            $this->load->view('templates/header_scan', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }

    }

    public function view_count(){
        $data['scans'] = $this->scan_model->view_by_count();

        $data['title'] = "Scan Totals";

        $this->load->view('templates/h_scan_table', $data);
        $this->load->view('scan/view_count', $data);
        $this->load->view('templates/footer');

    }

    //delete an individual scan
    public function delete($participant_id,$qr_scanned){
        $this->scan_model->delete($participant_id,$qr_scanned);

        $data['title']="Deleted Scan";
        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
    }

    //delete all scans made by a participant
    public function delete_all($participant_id){
        $this->scan_model->delete_all($participant_id);

        $data['title']="Deleted All Scans";
        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
    }
}
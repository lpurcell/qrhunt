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

            //if they scan their own qrcode and cookie is set, view their own profile page
            if (get_cookie('qrcode')== $participant_scanned && get_cookie('participant_id')){

                redirect('participant/'.get_cookie('qrcode'));
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
        $scanning_eventid = $data->Type;
        $scanning_qrcode = $data->QRCode;
        $scanning_name = $data->Participant_FName . " " . $data->Participant_LName;

        if($scanning_eventid == "ORG" || $scanning_eventid == "SCA"){

            $message['error'] = "Please scan your QR Code first to start the game.";
            $message['title'] = "Error";

            $this->load->view('templates/header', $data);
            $this->load->view('news/scan_notice', $message);
            $this->load->view('templates/footer');

        }else{

            if (!isset($_POST['Yes']) && !isset($_POST['No'])){

            $message['check'] = "Are you $scanning_name?";
            $message['title'] = "Name Check";

            $this->load->view('templates/header', $message);
            $this->load->view('news/scan_check', $message);
            $this->load->view('templates/footer');

            }elseif ($this->input->post('Yes') && isset($_POST["Yes"])){//set cookie
                $already_scanned = $CI->scan_model->check_scan($scanning_participant_id, $scanning_qrcode); //checks if the scan is already in the database

                if ($already_scanned == true){//this qrcode has already been scanned by another user and a cookie has been set
                    $message['error'] = "This QR Code is already in use.";
                    $message['participant_scanned'] = $scanning_qrcode;

                    $this->load->view('templates/header', $data);
                    $this->load->view('news/scan_notice', $message);
                    $this->load->view('templates/footer');

                }
                //if their cookie is set and they scan someone they haven't scanned before
                else{
                    $this->scan_model->scan($scanning_participant_id, $participant_scanned, $data);

                    $cookie = array(
                        array(
                            'name' => 'participant_id',
                            'value' => $scanning_participant_id,
                            'expire' => '259200',
                        ),
                        array(
                            'name' => 'Type',
                            'value' => $scanning_eventid,
                            'expire' => '259200',
                        ),
                        array(
                            'name' => 'qrcode',
                            'value' => $scanning_qrcode,
                            'expire' => '259200',
                        ),
                        array(
                            'name' => 'participant_name',
                            'value' => $scanning_name,
                            'expire' => '259200',
                        )
                    );

                    foreach($cookie as $cookies){
                        $this->input->set_cookie($cookies);
                    }

                    $message['title'] = "Name Check";

                    $this->load->view('templates/header', $message);
                    $this->load->view('news/success');
                    $this->load->view('templates/footer');
                }
            }
            elseif ($this->input->post('No') || isset($_POST['No'])){
                $message['error'] = "Please scan your QR Code first to start the game.";
                $message['title'] = "Error";

                $this->load->view('templates/header', $data);
                $this->load->view('news/scan_notice', $message);
                $this->load->view('templates/footer');
            }
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
         //if their cookie is set and they scan someone they haven't scanned before
        else{

            if (get_cookie('Type')=='LEA'){
                $event_check->Point = 0;
            }
            echo $event_check->Type;
            $this->scan_model->scan($participant_scanning, $participant_scanned, $event_check);
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
        $data['url_id'] = $slug;

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

    public function view_admin($slug){
        $CI =& get_instance();
        $CI->load->model('register_model');

        $data['participant'] = $this->scan_model->get_scans($slug);
        $result = $data['participant'];
        $data['participant_info'] = array();
        $data['url_id'] = $slug;

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
        $this->load->view('scan/view_admin', $data);
        $this->load->view('templates/footer');
    }
    //view who person was scanned by
    public function view_reverse($qrcode){
        $CI =& get_instance();
        $CI->load->model('register_model');

        $data['scans'] = $this->scan_model->scanned_by($qrcode);
        $data['title']="View Reverse";
        $result = $data['scans'];
        $data['scan_info'] = array();
        $data['url_id'] = $qrcode;

        if(empty($data['scans'])){
            $message['error'] = "You have not been scanned by anyone";

            $this->load->view('templates/header', $data);
            $this->load->view('news/scan_notice', $message);
            $this->load->view('templates/footer');
        }else{

        foreach($result as $row){
            $participant = $row->Participant_ID;

            $result2[] = $CI->register_model->find_by_id($participant);

            $data['scan_info'] = $result2;

        }
        $data['title'] = 'Participants Scanned ' . $qrcode;

        $this->load->view('templates/header_tables', $data);
        $this->load->view('scan/view_reverse', $data);
        $this->load->view('templates/footer');
        }
    }
    public function view_reverse_admin($qrcode){
        $CI =& get_instance();
        $CI->load->model('register_model');

        $data['scans'] = $this->scan_model->scanned_by($qrcode);
        $data['title']="View Reverse";
        $result = $data['scans'];
        $data['scan_info'] = array();
        $data['url_id'] = $qrcode;

        if(empty($data['scans'])){
            $message['error'] = "This person has not been scanned by anyone";

            $this->load->view('templates/header', $data);
            $this->load->view('news/scan_notice', $message);
            $this->load->view('templates/footer');
        }else{

        foreach($result as $row){
            $participant = $row->Participant_ID;

            $result2[] = $CI->register_model->find_by_id($participant);

            $data['scan_info'] = $result2;

        }
        $data['title'] = 'Participants Scanned ' . $qrcode;
        $data['lookupQRCode'] = $qrcode;

        $this->load->view('templates/header_tables', $data);
        $this->load->view('scan/view_reverse_admin', $data);
        $this->load->view('templates/footer');
       }
    }

    //view each scan made by a group
    public function group_scans_admin($groupname){
        $fixed_groupname = str_replace("%20", " ", $groupname);

        $data['scans'] = $this->scan_model->scan_by_group($fixed_groupname);

        $data['title']='Scans by '.$fixed_groupname;

        $this->load->view('templates/header_tables', $data);
        $this->load->view('scan/group_scans_admin', $data);
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
                'Type' => $this ->input->post('Type'),
                'Scan_Time' => $new_datetime
             );

            if ($this->input->post('Type') == "SCA"){
                $point_data = 5;
            }else if ($this->input->post('Type') == "ORG"){
                $point_data = 3;
            }else{
                $point_data = 1;
            }

            $new_data['Point'] = $point_data;

            $new_data['Point'] = $point_data;
            $this->scan_model->update($new_data);

            $this->load->view('templates/header_scan', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }

    }

    public function view_total(){
       $data['scans'] = $this->scan_model->view_by_total();

        $data['title'] = "Scan Totals by All Participants";

        $this->load->view('templates/h_scan_table', $data);
        $this->load->view('scan/view_total', $data);
        $this->load->view('templates/footer');
    }

    public function group_total(){
        $data['scans'] = $this->scan_model->view_group_total();

        $data['title'] = "Scan Totals by Group";

        $this->load->view('templates/h_scan_group', $data);
        $this->load->view('scan/group_total', $data);
        $this->load->view('templates/footer');
    }

    public function group_total_admin(){
        $data['scans'] = $this->scan_model->view_group_total();

        $data['title'] = "Scan Totals by Group";

        $this->load->view('templates/h_scan_group_admin', $data);
        $this->load->view('scan/group_total_admin', $data);
        $this->load->view('templates/footer');
    }
    //show total points by individual
    public function view_count_admin(){
        $data['scans'] = $this->scan_model->view_by_total();

        $data['title'] = "Scan Totals";

        $this->load->view('templates/h_scan_table_admin', $data);
        $this->load->view('scan/view_count_admin', $data);
        $this->load->view('templates/footer');

    }
    //delete old cookies
    public function delete_cookies(){
        $data['title']="Delete Cookies";

        if (get_cookie('event_id')){ //if they have old event_id cookie set
            delete_cookie('event_id');
            delete_cookie('participant_id');
            delete_cookie('qrcode');
            delete_cookie('participant_name');
        }else{ //delete cookie for data for Griffon Edge
            $this->scan_model->delete(get_cookie('participant_id'), get_cookie('qrcode'));
            delete_cookie('Type');
            delete_cookie('participant_id');
            delete_cookie('qrcode');
            delete_cookie('participant_name');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
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
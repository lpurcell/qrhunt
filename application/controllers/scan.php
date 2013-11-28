<?php
class Scan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scan_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
        $this->load->library(array('form_validation', 'user_agent', 'session'));


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
        if ($check_participant == null){
            $message['error'] = "Sorry, this QR Code does not exist.";
            $message['title'] = "Error";

            $this->load->view('templates/header', $message);
            $this->load->view('news/scan_notice',$message);
            $this->load->view('templates/footer');

         }else{
            //if they scan their own qrcode and a cookie is not set
            if (get_cookie('qrcode')!= $participant_scanned && !get_cookie('participant_id')){ //&& cookie is not set

                $participant_id = $check_participant->Participant_ID;
                $this->check_participantid($CI, $participant_id);
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

    /*checks the participant's name if there is not a cookie set/sets cookie
     When setting a cookie, a scan for that QRCode is put in the scan table to keep anyone else from trying to set a cookie for that QRCode
    */
    public function checkSet_cookie($CI, $participant_scanned_id){
        $data = $CI->register_model->participant_qrcode($participant_scanned_id);

        $scanning_participant_id = $data->Participant_ID;
        $scanning_eventid = $data->Event_ID;
        $scanning_qrcode = $data->QRCode;
        $scanning_name = $data->Participant_FName . " " . $data->Participant_LName;

         //do checks before setting cookie
         $already_scanned = $CI->scan_model->check_scan($scanning_participant_id, $scanning_qrcode); //checks if the scan is already in the scan table of database

            if ($already_scanned == true){//this qrcode has already been scanned by another user and a cookie has been set
                $message['title'] = "ID Error - ";
                $message['error'] = "This QR Code is already in use.";
                $message['participant_scanned'] = $scanning_qrcode;

                $this->load->view('templates/header', $message);
                $this->load->view('news/scan_notice', $message);
                $this->load->view('templates/footer');

            }else{ //if their cookie is not set and the initial qrcode scan is not in use

                $this->scan_model->scan($scanning_participant_id, $scanning_qrcode, $scanning_eventid); //put initial scan in scan table to database
                if ($this->agent->is_mobile()){
                    $agent_data = $this->agent->mobile();
                }else{
                    $agent_data = $this->agent->browser();
                }
                $CI =& get_instance();
                $CI->load->model('user_agent_model');
                $CI->user_agent_model->insert($scanning_participant_id, $agent_data);

                $cookie = array(
                    array(
                        'name' => 'participant_id',
                        'value' => $scanning_participant_id,
                        'expire' => '3600', //cookie will last for one hour
                    ),
                    array(
                        'name' => 'event_id',
                        'value' => $scanning_eventid,
                        'expire' => '3600',
                    ),
                    array(
                        'name' => 'qrcode',
                        'value' => $scanning_qrcode,
                        'expire' => '3600',
                    ),
                    array(
                        'name' => 'participant_name',
                        'value' => $scanning_name,
                        'expire' => '3600',
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

    public function check_participantid($CI, $scanned_participantid){


        if (!isset($_POST['entered_id'])){
            $data['title'] = "Check ID - ";
            $this->load->view('templates/header', $data);
            $this->load->view('scan/check_participantid');
            $this->load->view('templates/footer');

        }else{

            $entered_id = $_POST['entered_id'];
            if ($entered_id == $scanned_participantid){

                $this->checkSet_cookie($CI, $scanned_participantid);

            } else {
                $message['error'] = "Please scan your QR Code first to start the game.";
                $message['title'] = "ID Error - ";

                $this->load->view('templates/header', $message);
                $this->load->view('news/scan_notice', $message);
                $this->load->view('templates/footer');
            }
        }

    }

    //checks if the scan is already in the database, if not sends to model
    public function check_scan($CI, $participant_scanned){
        $participant_scanning = get_cookie('participant_id');
        $participant_eventid = get_cookie('event_id');

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

            $this->scan_model->scan($participant_scanning, $participant_scanned, $participant_eventid);
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

        if(count($data['participant'])== 1){//user only has 1 scan which is the initial scan
            $message['error'] = "You haven't scanned any QR Codes yet! Go scan some!!";

            $this->load->view('templates/header', $data);
            $this->load->view('news/participant_redirect', $message);
            $this->load->view('templates/footer');
        }else{

            foreach($result as $row){
                $qr_scanned = $row->QR_Scanned;

                $result2[] = $CI->register_model->get_name($qr_scanned);

                $data['participant_info'] = $result2;

            }
            $data['title'] = 'Scans by You';

            $this->load->view('templates/header_tables', $data);
            $this->load->view('scan/view', $data);
            $this->load->view('templates/footer');
        }
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

        //check if admin is logged in
        if (!$this->session->userdata("id")) { //not an admin, so show user view

            if(count($data['scans'])== 1){ //user only has 1 scan which is the initial scan
                $message['error'] = "Your QR Code has not been scanned yet.";

                $this->load->view('templates/header', $data);
                $this->load->view('news/participant_redirect', $message);
                $this->load->view('templates/footer');
            }else{

                foreach($result as $row){
                    $participant = $row->Participant_ID;

                    $result2[] = $CI->register_model->find_by_id($participant);

                    $data['scan_info'] = $result2;

                }
                $data['title'] = 'Participants Scanned Who Scanned ' . $qrcode . ' Code';

                $this->load->view('templates/header_tables', $data);
                $this->load->view('scan/view_reverse', $data);
                $this->load->view('templates/footer');
            }
        }else{ //user is an admin, so show admin view

            $CI2 =& get_instance();
            $CI2->load->model('event_model');

            $data['events'] = $CI2->event_model-> event_names();


            if(count($data['scans'])== 1){ //user only has 1 scan which is the initial scan
                $message['error'] = "This Player's QR Code has not been scanned yet.";

                $this->load->view('templates/header', $data);
                $this->load->view('news/scan_notice', $message);
                $this->load->view('templates/footer');
            }else{

                foreach($result as $row){
                    $participant = $row->Participant_ID;

                    $result2[] = $CI->register_model->find_by_id($participant);

                    $data['scan_info'] = $result2;

                }
                $data['title'] = 'Participants Scanned Who Scanned ' . $qrcode . ' Code';

                $this->load->view('templates/header_tables', $data);
                $this->load->view('scan/view_reverse_admin', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function edit($participant_id, $qr_scanned){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
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

    }

    public function view_count(){

        $participant_eventid = get_cookie('event_id');
        $data['scans'] = $this->scan_model->view_by_count($participant_eventid);

        $data['title'] = "Game Points";

        //check if admin is logged in
        if (!$this->session->userdata("id")) { //show user view

            $this->load->view('templates/h_scan_table', $data);
            $this->load->view('scan/view_count', $data);
            $this->load->view('templates/footer');

        }else{ //show admin view

            $this->load->view('templates/h_scan_table', $data);
            $this->load->view('scan/view_count_admin', $data);
            $this->load->view('templates/footer');

        }
    }

    public function view_most_scanned(){
        $participant_eventid = get_cookie('event_id');
        $data['scans'] = $this->scan_model->scanned_most($participant_eventid);

        $data['title'] = "Most Scanned QR Codes";

        $this->load->view('templates/h_scan_table', $data);
        $this->load->view('scan/view_count', $data);
        $this->load->view('templates/footer');

    }

    /*delete cookies
    This will require a game administrator to log in to admin on player's phone to delete cookie.
    This will also delete the initial scan from the scan table when the player first scanned it, so the QRCode can be scanned again.
    */
    public function delete_cookies(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $participant_id = get_cookie('participant_id');
            $qr_scanned = get_cookie('qrcode');

            $this->scan_model->delete($participant_id, $qr_scanned); //delete initial scan in the database

            //delete the user agent from initial scan
            $CI =& get_instance();
            $CI->load->model('user_agent_model');
            $this->user_agent_model->delete($participant_id);

            $data['title']="Delete Cookies";

            delete_cookie('event_id');
            delete_cookie('participant_id');
            delete_cookie('qrcode');
            delete_cookie('participant_name');

            $this->load->view('news/success'); //no header and footer because generated css doesn't have the information it needs to generate the css
        }

    }

    //delete an individual scan
    public function delete($participant_id,$qr_scanned){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $this->scan_model->delete($participant_id,$qr_scanned);

            $data['title']="Deleted Scan";
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
    }

    //delete all scans made by a participant
    public function delete_all($participant_id){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $this->scan_model->delete_all($participant_id);

            $data['title']="Deleted All Scans";
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
    }
}
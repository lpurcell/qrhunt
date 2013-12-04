<?php
class Event extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->helper(array('form', 'html', 'file', 'date', 'cookie'));
        $this->load->library(array('form_validation', 'session'));

        $config['upload_path']   = './assets/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('Organization_ID', 'Organization_ID', 'required ');
        $this->form_validation->set_rules('Event_Name', 'Event Name:', 'required|max_length[45]|is_unique[event.Event_Name]');
        $this->form_validation->set_rules('Event_Location', 'Location', 'required|max_length[12]');
        $this->form_validation->set_rules('Event_Date', 'Date of Event:', 'callback_valid_date');
        $this->form_validation->set_rules('Event_Coordinator', 'Coordinator Name:', 'required|max_length[45]');
        $this->form_validation->set_rules('Event_Email', 'Coordinator Email:', 'required|valid_email');
        $this->form_validation->set_rules('Event_Logo', 'Logo for Event', 'callback_handle_upload');
        $this->form_validation->set_rules('Event_Maincolor', 'Main Color: ');
        $this->form_validation->set_rules('Event_Textcolor', 'Text Color:');
        $this->form_validation->set_rules('Event_Headercolor', 'Header Color:');
        $this->form_validation->set_rules('Event_Logobackground', 'Logo Background:');
        $this->form_validation->set_rules('Event_Footer', 'Footer Color:');
        $this->form_validation->set_rules('Event_Twitter', 'Event Twitter:','max_length[45]');

    }

    public function create()
    {
        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $CI =& get_instance();
            $CI->load->model('organization_model');
            $organization['organization'] = $CI->organization_model->organization_names();
            $data['title'] = 'Register Your Event';

            if ($this->form_validation->run() === FALSE)
            {
                $this->load->view('templates/header2', $data);
                $this->load->view('event/create', $organization);
                $this->load->view('templates/footer');

            }else{
                $this->event_model->event();


                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
            }
        }
    }

    function handle_upload(){

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error']!= 4){

            if ($this->upload->do_upload('userfile')){
                // set a $_POST value for 'image' that we can use later
                $upload_data    = $this->upload->data();
                $_POST['userfile'] = $upload_data['file_name'];

                //resize the image and replace
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 600;
                $config2['height'] = 400;
                $config2['overwrite'] = TRUE;

                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();

                return true;

            }else{
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('handle_upload', $this->upload->display_errors());
                return false;
            }
        }else{
            // return true because nothing was uploaded
            return true;
        }
    }

    public function valid_date($str){
        $current_date = date('Y-m-d');

        if ( preg_match("/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/", $str) ){

        }
        if (strtotime($str) >= strtotime($current_date)){

        }
        else{
            $this->form_validation->set_message('valid_date', 'Date Format Error');
            return false;
        }
    }
    public function index(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $data['event'] = $this->event_model->get_events();
            $data['title'] = 'List of Events';

            $this->load->view('templates/header_tables', $data);
            $this->load->view('event/index', $data);
            $this->load->view('templates/footer');
        }
    }

    public function view($slug){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $data['event'] = $this->event_model->get_events($slug);

            if(empty($data['event'])){
                show_404();
            }
            $data['title'] = 'Event_Name ' . $slug;

            $this->load->view('templates/header', $data);
            $this->load->view('event/view', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit($slug){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $CI =& get_instance();
            $CI->load->model('organization_model');
            $data['organization'] = $CI->organization_model->organization_names();

            $event = $this->event_model->find_by_id($slug);
            $data['Event'] = $event;
            $original_picture = $event -> Event_Logo;

            $data['title'] = 'Edit Event';

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header2', $data);
                $this->load->view('event/edit', $data);
                $this->load->view('templates/footer');

            }else{
                $new_data = array(
                    'Event_ID' => $this->input->post('EVENT_ID'),
                    'Organization_ID' => $this ->input->post('Organization_ID'),
                    'Event_Name' => $this->input->post('Event_Name'),
                    'Event_Date' => $this->input->post('Event_Date'),
                    'Event_Location' => $this->input->post('Event_Location'),
                    'Event_Email' => $this->input->post('Event_Email'),
                    'Event_Coordinator' => $this->input->post('Event_Coordinator'),
                    'Event_Email' => $this->input->post('Event_Email'),
                    'Event_Maincolor' => $this->input->post('Event_Maincolor'),
                    'Event_Textcolor' => $this->input->post('Event_Textcolor'),
                'Event_Headercolor' => $this->input->post('Event_Headercolor'),
                'Event_Logobackground' => $this->input->post('Event_Logobackground'),
                'Event_Footer' => $this->input->post('Event_Footer'),
                'Event_Twitter' => $this->input->post('Event_Twitter')
                );

                $new_picture = $this->input->post('userfile');

                if ($new_picture === "0" || $new_picture == ""){
                    $new_data['Event_Logo'] = $original_picture;
                }else{
                    $new_data['Event_Logo'] = $new_picture;
                }

                $this->event_model->update($new_data);
                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
            }
        }
    }

    public function delete($slug){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $this->event_model->delete($slug);

            $data['title']="Deleted Event";
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
    }

}
	
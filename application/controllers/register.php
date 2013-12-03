<?php
class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
        $this->load->library(array('form_validation', 'session'));

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('Participant_LName', 'Last Name', 'required|max_length[45]');
        $this->form_validation->set_rules('Participant_FName', 'First Name', 'required|max_length[45]');
        $this->form_validation->set_rules('Participant_Email', 'Email', 'required|valid_email|is_unique[participant.Participant_Email]');
       // $this->form_validation->set_rules('QRCode', 'QR Code', 'required|is_unique[participant.QRCode]');
        $this->form_validation->set_rules('MISC1', 'MISC 1','|max_length[100]');
        $this->form_validation->set_rules('MISC2', 'MISC 2','|max_length[40]');
        $this->form_validation->set_rules('MISC3', 'MISC 3','|max_length[40]');
        $this->form_validation->set_rules('Participant_Picture', 'Picture', '|callback_handle_upload');

    }

    public function create(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
            redirect('admin/login');

        }else{
            $CI =& get_instance();
            $CI->load->model('event_model');
            $event['event'] = $CI->event_model->event_names();

            $data['title'] = 'Register Your Profile';

             if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('register/create', $event);
                $this->load->view('templates/footer');
            }else{

                $this->register_model->register();
                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
             }
        }

    }

    public function handle_upload($str){

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error']!= 4){
            if ($this->upload->do_upload('userfile')){
                // set a $_POST value for 'image' that we can use later
                $upload_data    = $this->upload->data();
                $_POST['userfile'] = $upload_data['file_name'];

                //resize the image and replace
                $config['image_library'] = 'gd2';
                $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 150;
                $config['height'] = 100;
                $config['overwrite'] = TRUE;

                $this->load->library('image_lib', $config);
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

     public function index(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) {
             redirect('admin/login');

        }else{
            $data['participant'] = $this->register_model->get_participants();
            $data['title'] = 'List of Participants';

            $CI =& get_instance();
            $CI->load->model('event_model');

            $data['events'] = $CI->event_model-> event_names();

            $this->load->view('templates/header_tables_plain', $data);
            $this->load->view('register/index', $data);
            $this->load->view('templates/footer');
         }

    }

    public function view($slug){
        $participants = $this->register_model->get_participants($slug);

        $data['participant']=$participants;

        //TODO throw error if array size > 1 (404 as well?)
        if(empty($data['participant'])){
            show_404();
        }

        //$data['css'] = $participants->row(0)->Event_ID;
        $data['title'] = 'QRCode ' . $slug;

        $this->load->view('templates/header', $data);
        $this->load->view('register/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($slug){
        $participant = $this->register_model->find_by_id($slug);

        $data['Participant'] = $participant;
        $original_picture = $participant->Participant_Picture;

        //check if admin is logged in
        if (!$this->session->userdata("id")) {

        $data['title'] = 'Edit Your Profile';

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('register/edit', $data);
                $this->load->view('templates/footer');

            }else{
                $new_data = array(
                    'Participant_ID' => $this->input->post('PARTICIPANT_ID'),
                    'Event_ID' => $this ->input->post('Event_ID'),
                    'Participant_LName' => $this->input->post('Participant_LName'),
                    'Participant_FName' => $this->input->post('Participant_FName'),
                    'Participant_Email' => $this->input->post('Participant_Email'),
                    'QRCode' => $this->input->post('QRCode'),
                    'MISC1' => $this->input->post('MISC1'),
                    'MISC2' => $this->input->post('MISC2'),
                    'MISC3' => $this->input->post('MISC3')
                );

                $new_picture = $this->input->post('userfile');

                if ($new_picture === "0" || $new_picture == ""){
                    $new_data['Participant_Picture'] = $original_picture;
                }else{
                    $new_data['Participant_Picture'] = $new_picture;
                }

                $this->register_model->update($new_data);

                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
            }
        }else{
            $data['title'] = "Edit Player's Profile";

            $CI =& get_instance();
            $CI->load->model('event_model');
            $data['events'] = $CI->event_model->event_names();

            if ($this->form_validation->run() === FALSE){
                $this->load->view('templates/header', $data);
                $this->load->view('register/edit_admin', $data);
                $this->load->view('templates/footer');

            }else{
                $new_data = array(
                    'Participant_ID' => $this->input->post('PARTICIPANT_ID'),
                    'Event_ID' => $this->input->post('Event_ID'),
                    'Participant_LName' => $this->input->post('Participant_LName'),
                    'Participant_FName' => $this->input->post('Participant_FName'),
                    'Participant_Email' => $this->input->post('Participant_Email'),
                    'QRCode' => $this->input->post('QRCode'),
                    'MISC1' => $this->input->post('MISC1'),
                    'MISC2' => $this->input->post('MISC2'),
                    'MISC3' => $this->input->post('MISC3')
                );

                $new_picture = $this->input->post('userfile');

                if ($new_picture === "0" || $new_picture == ""){
                    $new_data['Participant_Picture'] = $original_picture;
                }else{
                    $new_data['Participant_Picture'] = $new_picture;
                }

                $this->register_model->update($new_data);

                $this->load->view('templates/header', $data);
                $this->load->view('news/success');
                $this->load->view('templates/footer');
            }

        }

    }

    public function delete($slug){

        if (!$this->session->userdata("id")) {
                redirect('admin/login');

        }else{

            $this->register_model->delete($slug);

            $data['title']="Deleted Participant";
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
    }


}




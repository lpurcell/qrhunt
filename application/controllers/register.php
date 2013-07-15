<?php
class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
        $this->load->library('form_validation');

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('Participant_LName', 'Last Name', 'required');
        $this->form_validation->set_rules('Participant_FName', 'First Name', 'required');
        $this->form_validation->set_rules('Participant_Email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('QRCode', 'QR Code', 'required');
        $this->form_validation->set_rules('Participant_Website', 'Personal Website');
        $this->form_validation->set_rules('Participant_Picture', 'Picture', 'callback_handle_upload');

    }

    public function create()
    {
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
            $this->load->view('news/success');
        }

    }

    function handle_upload(){

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
        $data['participant'] = $this->register_model->get_participants();
        $data['title'] = 'List of Participants';

        $this->load->view('templates/header_tables', $data);
        $this->load->view('register/index', $data);
        $this->load->view('templates/footer');

    }

    public function view($slug){
        $participants = $this->register_model->get_participants($slug);
        if(empty($data['participant'])){
            show_404();
        }
        //TODO throw error if array size > 1 (404 as well?)
        $data['participant']=$participants;

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

        $data['title'] = 'Edit Your Profile';

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('register/edit', $data);
            $this->load->view('templates/footer');

        }else{
            $new_data = array(
                'Participant_ID' => $this->input->post('Participant_ID'),
                'Event_ID' => $this ->input->post('Event_ID'),
                'Participant_LName' => $this->input->post('Participant_LName'),
                'Participant_FName' => $this->input->post('Participant_FName'),
                'Participant_Email' => $this->input->post('Participant_Email'),
                'QRCode' => $this->input->post('QRCode'),
                'Participant_Website' => $this->input->post('Participant_Website')
            );

            $new_picture = $this->input->post('userfile');

            if ($new_picture === "0" || $new_picture == ""){
                $new_data['Participant_Picture'] = $original_picture;
            }else{
                $new_data['Participant_Picture'] = $new_picture;
            }

            $this->register_model->update($new_data);
            $this->load->view('news/success');
        }

    }

    public function delete($slug){
        $this->register_model->delete($slug);
        $this->load->view('news/success');
    }


}




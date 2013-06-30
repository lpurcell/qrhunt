<?php
class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper(array('form', 'html', 'file'));
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
        $data['title'] = 'Register Your Profile';

         if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('register/create');
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

        $this->load->view('templates/header', $data);
        $this->load->view('register/index', $data);
        $this->load->view('templates/footer');

    }

    public function view($slug){
        $data['participant'] = $this->register_model->get_participants($slug);

        if(empty($data['participant'])){
            show_404();
        }
       $data['title'] = 'QRCode ' . $slug;

        $this->load->view('templates/header', $data);
        $this->load->view('register/view', $data);
        $this->load->view('templates/footer');
    }



}




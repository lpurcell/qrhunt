<?php
class Register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('register_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
        $this->load->library('form_validation');

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);



        $this->form_validation->set_rules('Participant_LName', 'Last Name', 'required|max_length[45]');
        $this->form_validation->set_rules('Participant_FName', 'First Name', 'required|max_length[45]');
        $this->form_validation->set_rules('Groups', 'Group', 'required');
        $this->form_validation->set_rules('Major', 'Major','|max_length[45]');

    }

    public function create()
    {
        $data['title'] = 'Register Your Profile';

         if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('register/create');
            $this->load->view('templates/footer');
        }else{

             if ($this->input->post('Type') == "SCA"){
                 $point_data = 5;
             }else if ($this->input->post('Type') == "ORG"){
                 $point_data = 3;
             }else if ($this->input->post('Type') == "LEA"){
                 $point_data = 0;
             }else{
                 $point_data = 1;
              }

            $this->register_model->register($point_data);
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
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
        $data['participant'] = $this->register_model->get_participants();
        $data['title'] = 'List of Participants';

        $this->load->view('templates/header_tables', $data);
        $this->load->view('register/index', $data);
        $this->load->view('templates/footer');

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
    public function edit_start(){
        $data['title'] = 'Add a Participant';

        if (!isset($_POST['QRCode']) || $_POST['QRCode'] == null) {
            $this->load->view('templates/header', $data);
            $this->load->view('register/edit_start', $data);
            $this->load->view('templates/footer');

        } else {
            $qrcode = $_POST['QRCode'];

            redirect('participant_edit/'.$qrcode);

        }
    }
    public function edit($slug){
        $participant = $this->register_model->find_by_qrcode($slug);

        if ($participant == null ){
            show_404();
        }

        $data['Participant'] = $participant;

        $data['title'] = 'Edit Profile '.$slug;


        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('register/edit', $data);
            $this->load->view('templates/footer');

        }else{
            $new_data = array(
                'Participant_ID' => $this->input->post('PARTICIPANT_ID'),
                'Type' => $this ->input->post('Type'),
                'Participant_LName' => $this->input->post('Participant_LName'),
                'Participant_FName' => $this->input->post('Participant_FName'),
                'Groups' => $this->input->post('Groups'),
                'QRCode' => $this->input->post('QRCode'),
                'Major' => $this->input->post('Major')
            );

            if ($this->input->post('Type') == "SCA"){
                $point_data = 5;
            }else if ($this->input->post('Type') == "ORG"){
                $point_data = 3;
            }else if ($this->input->post('Type') == "LEA"){
                $point_data = 0;
            }else{
                $point_data = 1;
            }

            $new_data['Point'] = $point_data;

            $this->register_model->update($new_data);

            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }

    }

    public function delete($slug){
        $this->register_model->delete($slug);

        $data['title']="Deleted Participant";
        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
    }


}




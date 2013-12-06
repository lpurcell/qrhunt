<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Meagan Gates
 * Organization: Missouri Western State University
 * Date: 10/15/13
 * Time: 2:03 PM
 */
class Mult_register extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mult_register_model');
        $this->load->helper(array('form', 'html', 'file', 'url', 'cookie'));
        $this->load->library('form_validation');

        $config['upload_path']   = './downloads/';
        $config['allowed_types'] = 'csv';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);


        $this->form_validation->set_rules('CSV_File', 'File', 'required|callback_handle_upload');

    }

    public function create()
    {
        $CI =& get_instance();
        $CI->load->model('event_model');
        $data['event'] = $CI->event_model->event_names();

        $data['title'] = 'submit';

        if (! $this->upload->do_upload() && $this->form_validation->run() === FALSE)
        {
            $data['error'] = array('error' => $this->upload->display_errors());

            $this->load->view('templates/header', $data);
            $this->load->view('register/multCreate', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $this->mult_register_model->register(); //or you can do $this->upload->do_upload
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }

    }

    public function handle_upload($str){

        if (isset($_FILES['userfile']) && $_FILES['userfile']['error']!= 4){
            echo "here";
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
}
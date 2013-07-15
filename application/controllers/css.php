<?php
class Css extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('css_model');

    }

     public function get($Event_ID){

         $data = array('event' => $this->css_model->get_css());


         $this->load->view('css/get', $data);

     }
}
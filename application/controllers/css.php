<?php
class Css extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('css_model');
        $this->load->helper('cookie');

    }

     public function get($Event_ID){

         $data = array('event' => $this->css_model->get_css(get_cookie('event_id')));


         $this->load->view('css/get', $data);

     }
}
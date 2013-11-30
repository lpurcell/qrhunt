<?php
class User_agent extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_agent_model');
        $this->load->helper(array('html', 'url', 'cookie'));
        $this->load->library('session');
    }

    public function index_mobile(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) { //admin is not logged in
            redirect('admin/login');

        }else{ //admin is logged in
            $data['agents'] = $this->user_agent_model->get_mobile_agents();

            $data['title'] = 'Mobile User Agent Totals';

            if ($data['agents']==null){
                $data['error'] = "You don't have any mobile user agents.";

                $this->load->view('templates/header', $data);
                $this->load->view('news/scan_notice', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header_tables', $data);
                $this->load->view('user_agent/index_mobile', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    public function index_browser(){

        //check if admin is logged in
        if (!$this->session->userdata("id")) { //admin is not logged in
            redirect('admin/login');

        }else{ //admin is logged in

            $data['agents'] = $this->user_agent_model->get_browser_agents();

            $data['title'] = 'Browser User Agent Totals';

            if ($data['agents']==null){
                $data['error'] = "You don't have any broswer user agents.";

                $this->load->view('templates/header', $data);
                $this->load->view('news/scan_notice', $data);
                $this->load->view('templates/footer');
            }else{
                $this->load->view('templates/header_tables', $data);
                $this->load->view('user_agent/index_browser', $data);
                $this->load->view('templates/footer');
            }
        }
    }

}
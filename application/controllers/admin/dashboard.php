<?php
class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
		
		$this->load->helper(array('form', 'cookie'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_m');
		
		// Login check
		$exception_uris = array(
			'admin/login', 
			'admin/logout'
		);
		
		//check to see if user is logged in
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				redirect('admin/login');
			}
		}
    }

    public function index($page = 'home'){
        $this->load->helper(array('cookie'));
		if ( ! file_exists('application/views/pages/'.$page.'.php')){
		// Whoops, we don't have a page for that!
		show_404();
	}
	$data['title'] = ucfirst($page); // Capitalize the first letter
	

	$this->load->view('templates/header', $data);	
	$this->load->view('admin/pages/'.$page, $data);;	
	$this->load->view('templates/footer', $data);
	}
	
    
    public function modal() {
    	$this->load->view('admin/_layout_modal', $this->data);
    }
}
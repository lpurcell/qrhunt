<?php
class User extends CI_Controller
{
	
	// num of records per page
	private $limit = 10;

	public function __construct(){
        parent::__construct();
		
		$this->load->helper(array('form', 'cookie'));
		
		$this->load->library('session');
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load model
		$this->load->model('user_m','',TRUE);
		
		// Login check
		$exception_uris = array(
			'admin/user/login', 
			'admin/user/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				redirect('admin/user/login');
			}
		}
    }

	function index($offset = 0)
	{
		$data['title'] = 'List of Users';
		$data['link_dashboard'] = anchor('admin/dashboard','Back to dashboard',array('class'=>'back'));
		
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data
		$users = $this->user_m->get_paged_list($this->limit, $offset)->result();
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('admin/user/index/');
 		$config['total_rows'] = $this->user_m->count_all();
 		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No', 'Name', 'Actions');
		$i = 0 + $offset;
		foreach ($users as $user)
		{
			$this->table->add_row(++$i, $user->name, 
				anchor('admin/user/view/'.$user->id,'view',array('class'=>'view')).' '.
				anchor('admin/user/update/'.$user->id,'update',array('class'=>'update')).' '.
				anchor('admin/user/delete/'.$user->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Are you sure want to delete this user?')"))
			);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userList', $data);
		$this->load->view('templates/footer');
	}

	function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Add new user';
		$data['message'] = '';
		$data['action'] = site_url('admin/user/adduser');
		$data['link_back'] = anchor('admin/user/index/','Back to list of users',array('class'=>'back'));
	
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userAdd', $data);
		$this->load->view('templates/footer');
	}
	
	function adduser()
	{
		// set common properties
		$data['title'] = 'Add new user';
		$data['action'] = site_url('admin/user/adduser');
		$data['link_back'] = anchor('admin/user/index/','Back to list of users',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$user = array('name' => $this->input->post('name'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post('password')),
							'pwchange' => $this->input->post('changePassword'),
							'email' => $this->input->post('email'));												
			$id = $this->user_m->save($user);
			
			// set user message
			$data['message'] = '<div class="success">add new user success</div>';
		}		
		
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userAdd', $data);
		$this->load->view('templates/footer');
	}

	function view($id)
	{
		// set common properties
		$data['title'] = 'User Details';
		$data['link_back'] = anchor('admin/user/index/','Back to list of users',array('class'=>'back'));
		$data['link_dashboard'] = anchor('admin/dashboard','Back to dashboard',array('class'=>'back'));
		
		// get user details
		$data['user'] = $this->user_m->get_by_id($id)->row();
		
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userView', $data);
		$this->load->view('templates/footer');
	}

	function update($id)
	{
		// set validation properties
		$this->_set_update_rules();
		
		// prefill form values
		$user = $this->user_m->get_by_id($id)->row();
		$this->form_data = new stdClass;
		$this->form_data->id = $user->id;
		$this->form_data->name = $user->name;
		$this->form_data->username = $user->username;
		$this->form_data->email = $user->email;		
				
		// set common properties
		$data['title'] = 'Update user';
		$data['message'] = '';
		$data['action'] = site_url('admin/user/updateuser');
		$data['link_back'] = anchor('admin/user/index/','Back to list of users',array('class'=>'back'));	
		$data['link_dashboard'] = anchor('admin/dashboard','Back to dashboard',array('class'=>'back'));	
        
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userEdit', $data);
		$this->load->view('templates/footer');
	}
	
	function updateuser()
	{
		// set common properties
		$data['title'] = 'Update user';
		$data['action'] = site_url('admin/user/updateuser');
		$data['link_back'] = anchor('admin/user/index/','Back to list of users',array('class'=>'back'));
		$data['link_dashboard'] = anchor('admin/dashboard','Back to dashboard',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_update_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$user = array('name' => $this->input->post('name'),
							'username' => $this->input->post('username'),
							'password' => md5($this->input->post("password")),
							'pwchange' => $this->input->post('changePassword'),
							'email' => $this->input->post('email'));
			$this->user_m->update($id,$user);
			
			// set user message
			$data['message'] = '<div class="success">update user success</div>';
		}		
		
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/userEdit', $data);
		$this->load->view('templates/footer');
	}

	function updatePass()
	{
		
		// set validation properties
		$this->_set_updatepw_rules();				
				
		// set common properties
		$data['title'] = 'Change Password';
		$data['message'] = '';
		$data['action'] = site_url('admin/user/updateuserpass');
		
		// load view
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/updatepw', $data);
		$this->load->view('templates/footer');
	}
	
	function updateuserPass()
	{
		// set common properties
		$data['title'] = 'Change Password';
		$data['action'] = site_url('admin/user/updateuserpass');
		$data['link_back'] = anchor('user/index/','Back to list of users',array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_updatepw_rules();
		
		// run validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$user = array('name' => $this->input->post('name'),
							'password' => md5($this->input->post("password")),
							'pwchange' => $this->input->post('changePassword'));							
			$this->user_m->update($id,$user);
			redirect('admin/dashboard');
			
			// set user message
			$data['message'] = '<div class="success">update user success</div>';
		}		
		
		// load view
		$this->load->view('templates/header', $data);
		$this->load->view('admin/user/updatepw', $data);
		$this->load->view('templates/footer');
	}

	public function delete ($id)
	{
		$this->user_m->delete($id);
		redirect('admin/user');
	}	

	public function logout ()
	{
		$this->user_m->logout();
		//redirect('admin/user/login');
		redirect('pages/view');
	}
	
	// set empty default form field values
	function _set_fields()
	{
		
		$this->form_data = new stdClass;
		$this->form_data->id = '';
		$this->form_data->name = '';
		$this->form_data->username = '';
		$this->form_data->password= '';
		$this->form_data->email = '';
		

		
	}
	
	// validation rules
	function _set_rules()
	{
		$this->form_validation->set_rules('id', 'Id');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|min_length[5]');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|max_length[30]|min_length[5]|callback_username_is_taken');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|min_length[6]');
		$this->form_validation->set_rules('pass_conf', 'Repeat Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}	
	
	// validation update rules
	function _set_update_rules()
	{
		$this->form_validation->set_rules('id', 'Id');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|min_length[5]');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|max_length[20]|min_length[5]');
		$required_if = $this->input->post('password') ? '|required' :'';
		$this->form_validation->set_rules('password', 'Password', 'trim'. $required_if .'|max_length[20]|min_length[6]');
		$this->form_validation->set_rules('pass_conf', 'Repeat Password', 'trim'. $required_if .'|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');		
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}

	// validation update rules
	function _set_updatepw_rules()
	{
		$this->form_validation->set_rules('id', 'Id');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[50]|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|min_length[6]');
		$this->form_validation->set_rules('pass_conf', 'Repeat Password', 'trim|required|matches[password]');
		
		
		$this->form_validation->set_message('required', '* required');
		$this->form_validation->set_message('isset', '* required');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
	}	

	//username_validation callback
	public function username_is_taken( $input) {

		$query = "SELECT * FROM `users` WHERE `username` = ?";
		$arg   = array( $input );
		$exec  = $this->db->query($query, $arg) or die(mysql_error());

		if( $exec->num_rows() > 0 ) 
		{
			$this->form_validation->set_message('username_is_taken', 'Sorry the username <b> '.$input.' </b> is taken!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function _unique_email ($str)
	{
		// Do NOT validate if email already exists
		// UNLESS it's the email for the current user
		
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		!$id || $this->db->where('id !=', $id);
		$user = $this->user_m->get();
		
		if (count($user)) {
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
	
	
}
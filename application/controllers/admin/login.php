<?php

	class Login extends CI_Controller {
		
		public function __construct(){
        parent::__construct();
		
		$this->load->helper(array('form', 'cookie'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('user_m');
		
		
		}
		

		public function index()		
		{
			$data['title'] = 'Log In';
			
			$this->load->helper(array('form', 'cookie'));

			$this->load->library('form_validation');
			
			
			//Begins the code.
			
				$rules = array( 

						"tf_account" => array(
								"field" => "tf_account",
								"label" => "Username or Email",
								"rules" => "required|trim|callback_account_exist"
							),
						"tf_password" => array(
								"field" => "tf_password",
								"label" => "Password",
								"rules" => "required"
							)
					);
				$this->form_validation->set_rules($rules);
			if( $this->form_validation->run() != true )
			{
				//Load Login Page
				$this->load->view('templates/header', $data);
				$this->load->view('admin/pages/login', $data);
				$this->load->view('templates/footer');
			} else {
				
				$input = $this->input->post("tf_account");		//Forms Text Field Account.
				$password = md5($this->input->post("tf_password")); //Forms Text Field Password.
				$this->load->helper("email");

				$type = ""; //--> Set blank var

				if( valid_email($input) ): //Checks to see if valid email
					$type = "email";
					else:
					$type = "username";
				endif;


				switch( $type )
				{
					case "email":
						$sql = "SELECT * FROM `users` WHERE `email` = '".mysql_real_escape_string(addslashes(strip_tags($input)))."'";
					break;

					case "username":
						$sql = "SELECT * FROM `users` WHERE `username` = '".mysql_real_escape_string(addslashes(strip_tags($input)))."'";
					break;
				}

				$sql = $this->db->query($sql) or die(mysql_error());

				if( $sql->num_rows() > 0 )
				{
					foreach($sql->result() as $data)
					{
						$db_id = $data->id;
						$db_name = $data->name;
						$db_password = $data->password;
						$db_username = $data->username;
						$db_email	 = $data->email;
					}

					if( $password == $db_password )
					{
						$this->session->set_userdata("loggedin", true);
						$this->session->set_userdata("id",$db_id);
						$this->session->set_userdata("username",$db_username);
						$this->session->set_userdata("name",$db_name);
						$this->session->set_userdata("email", $db_email);
						$this->session->set_flashdata("notification", "Successful login $db_username");
						
						//check to see if they need to change password
						$pwsql = "SELECT * FROM users WHERE username = ? and pwchange = '1'";
						$pwquery = $this->db->query($pwsql, array($db_username,));
						if ($pwquery->num_rows() > 0) {
							redirect(base_url()."admin/user/updatepass");							
						} else {							
							redirect(base_url()."admin/dashboard"); //Replace with a controller of choice.
						}
						
						
					} else { 
						//Incorrect Password
						$this->session->set_flashdata("pw_error", "Sorry, the password you entered is incorrect!");
						$this->session->set_flashdata("tf_account", $input);
						redirect(base_url()."admin/login");
					}
				}
			}
			
	}

		/***** Account Exist Method*****/
		public function account_exist( $input )
		{
			//Load Email Helper
			$this->load->helper("email");

			$type = ""; //--> Set blank var

			if( valid_email($input) ): //Checks to see if valid email
				$type = "email";
				else:
				$type = "username";
			endif;

			switch( $type )
			{
				case "email":
					$sql = "SELECT * FROM `users` WHERE `email` = '$input'";
				break;

				case "username":
					$sql = "SELECT * FROM `users` WHERE `username` = '$input'";
				break;
			}

			$exec = $this->db->query($sql);

			if( $exec->num_rows()<1) //Account doesn't exist.
			{
				$this->form_validation->set_message("account_exist", "The $type you entered doesn't exist!");
				return FALSE;	
			} else {
				return TRUE;
			}
		}

	}
	
?>
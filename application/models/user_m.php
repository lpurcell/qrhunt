<?php
class User_M extends MY_Model
{
	
	protected $_table_name = 'users';
	private $tbl_users= 'users';
	protected $_order_by = 'name';
	

	function __construct ()
	{
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_users);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_users);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_users, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_users);
	}
	
	function get_by_username(){
		$this->db->where('username', $username);
		return $this->db->get($this->tbl_users);
	}
	
	function save($user){
		$this->db->insert($this->tbl_users, $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_users, $user);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_users);
	}

	public function logout ()
	{
		$unset_sessions = array(
						"logged_in" => false,
						"username" => "",
						"name"=>"",
						"id"=>"",
						"email" => "",
						"level" => 0
					);

		$this->session->unset_userdata($unset_sessions);
		
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}	
	
	
	public function get_new(){
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		return $user;
	}

	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
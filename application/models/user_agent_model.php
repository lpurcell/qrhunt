<?php
 class User_agent_model extends CI_Model {

     public function __construct()
     {
         $this->load->database();
     }

     public function insert($participant_id, $user_agent){
         $data= array(
             'Participant_ID' => $participant_id,
             'Agent' => $user_agent
         );

         return $this->db->insert('user_agent', $data);
     }

     public function get_mobile_agents(){
         $where = "Agent != 'Chrome' AND Agent != 'Mozilla' AND Agent != 'Opera' AND Agent != 'Safari'";
         $this->db->select("Agent, count(Agent) as Total");
         $this->db->from('user_agent');
         $this->db->where($where);
         $this->db->group_by("Agent");

         return $this->db->get()->result();
     }

     public function get_browser_agents(){
         $where = "Agent = 'Chrome' AND Agent = 'Mozilla' AND Agent = 'Opera' AND Agent = 'Safari'";
         $this->db->select("Agent, count(Agent) as Total");
         $this->db->from('user_agent');
         $this->db->where($where);
         $this->db->group_by("Agent");

         return $this->db->get()->result();
     }

 }
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

 }
<?php

class Organization_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function organization(){

        $data = array(
            'Organization_Name' => $this ->input->post('Organization_Name'),
            'Organization_Sponsor' => $this->input->post('Organization_Sponsor')
        );

        return $this->db->insert('organization', $data);
    }

public function find_by_id($organization_id){
    $this->db->select('Organization_ID, Organization_Name, Organization_Sponsor');
    $this->db->from('organization');
    $this->db->where('Organization_ID', $organization_id);
    return $this->db->get()->row(0);
}

public function get_organizations($slug = FALSE){

    if($slug === FALSE){
        $this->db->select('Organization_ID, Organization_Name, Organization_Sponsor');
        $this->db->from('organization');
        //need to filter data
        //$this->db->where('')
        return $this->db->get()->result();
    }
    $this->db->select('Organization_ID, Organization_Name, Organization_Sponsor');
    $this->db->from('organization');
    $this->db->where('Organization_ID', $slug);
    return $this->db->get()->result();
}

public function update($data){

    $this->db->where('Organization_ID', $data['Organization_ID']);
    $this->db->update('organization', $data);
}
}

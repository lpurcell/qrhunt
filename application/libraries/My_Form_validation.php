<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Form_validation extends CI_Form_validation {

    public function is_unique($str, $field)
    {
        list($table, $field)=explode('.', $field);

        $q = $this->CI->db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'")->row();
        $primary_key = $q->Column_name;

        if($this->CI->input->post($primary_key) > 0):
             $this->CI->db->from($table);
             $this->CI->db->where(array($field => $str, $primary_key ." !=" =>$this->CI->input->post($primary_key)));

            $query = $this->CI->db->get()->row();

        else://if person is registering then they have no id and will check if it is already in database
            $this->CI->db->from($table);
            $this->CI->db->where(array($field => $str));
            $query = $this->CI->db->get()->row();

        endif;

        if (empty($query)){
           return true;
        }else{
           return false;
        }

    }
}


/* End of file My_Form_validation.php */
/* Location: ./application/libraries/My_Form_validation.php */ 
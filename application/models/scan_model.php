<?php
class Scan_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('form', 'html', 'file', 'url', 'date'));
    }
    //regular scan
    public function scan($participant_scanning, $participant_scanned)
    {
        $data = array(
            'Participant_ID' => $participant_scanning,
            'QR_Scanned' => $participant_scanned,
        );

        //set the date and time
        $this->db->set('Scan_Time', 'now()', FALSE);

        //if a duplicate is attempted to be entered, the database will throw an error, this keeps it from doing that. The duplicate data is not entered.
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        $this->db->insert('scan', $data);

        $this->db->db_debug = $db_debug;
        return;
    }

    //manual scan
    public function scan_manual(){
        $data = array(
            'Participant_ID' => $this->input->post('Participant_ID'),
            'QR_Scanned' => $this->input->post('QR_Scanned')
        );

        //set the date and time
        $this->db->set('Scan_Time', 'now()', FALSE);

        $this->db->insert('scan', $data);
    }

    public function delete($participant_id, $qr_scanned){
        $this->db->delete('scan', array('Participant_ID'=>$participant_id, 'QR_Scanned'=>$qr_scanned));
    }

    public function get_scans($slug = FALSE){

        if($slug === FALSE){

            $this->db->get('scan');
            //need to filter data
            //$this->db->where('')
            return $this->db->get()->result();
        }

        $this->db->select("Participant_ID, QR_Scanned, date_format(Scan_Time,'%m-%d-%Y')as Date, date_format(Scan_Time, '%h:%i:%s') as Time", false);
        $this->db->from('scan');
        $this->db->where('Participant_ID', $slug);

        return $this->db->get()->result();

    }
    //edit function
    public function update($data){

        $this->db->where('Participant_ID', $data['Participant_ID']);
        $this->db->where('QR_Scanned', $data['QR_Scanned']);
        $this->db->update('scan', $data);
    }

    //part of edit function
    public function find_by_id($participant_id, $qr_scanned){
        $this->db->select("Participant_ID, QR_Scanned, date_format(Scan_Time,'%m-%d-%Y')as Date, date_format(Scan_Time, '%h:%i:%s') as Time", false);
        $this->db->from('scan');
        $this->db->where('Participant_ID', $participant_id);
        $this->db->where('QR_Scanned', $qr_scanned);

        return $this->db->get()->row(0);
    }
}
<?php
/**
 * Missouri Western State University
 * User: Meagan Gates
 * Date: 10/24/13
 * Time: 4:21 PM
 */

class Labels extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('labels_model');
        $this->load->helper(array('html', 'url', 'cookie', 'form', 'file'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Event_ID', 'Event', 'required');
    }

    public function index() {
        if ($this->form_validation->run() == FALSE)
        {
            $CI =& get_instance();
            $CI->load->model('event_model');
            $event['event'] = $CI->event_model->event_names();
            $data['title'] = 'Create Participant Labels';

            $this->load->view('templates/header', $data);
            $this->load->view('labels/labels', $event);
            $this->load->view('templates/footer');
        }
        else
        {
            $event = $this ->input->post('Event_ID');
            $data['title'] = 'Participant Labels';


            if($this->labels_model->get_participants($event) !== "Error") {
                $data['participants'] = $this->labels_model->get_participants($event);
                $data['event'] = $this->get_event();

                $this->load->view('templates/header', $data);
                $this->load->view('labels/labelsGenerated', $data);
                $this->load->view('templates/footer');
            }
            else {
                $this->load->view('templates/header', $data);
                $this->load->view('labels/labelsNoParticipantsError');
                $this->load->view('templates/footer');
            }
        }


    }

    public function get_event() {
        $event = $this ->input->post('Event_ID');
            $event_name = $this->labels_model->get_event($event);
            foreach ($event_name->result() as $row)
            {
                $event_name = $row->EVENT_NAME;
            }
            return (string) $event_name;
    }
}
?>
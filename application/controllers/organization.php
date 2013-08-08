<?php
class Organization extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('organization_model');
        $this->load->helper(array('form', 'html', 'cookie'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Organization_Name', 'Organization Name', 'required|max_length[12]|unique[organization.Organization_Name]');
        $this->form_validation->set_rules('Organization_Sponsor', 'Sponsor Name', 'required|max_length[12]');
    }

    public function create()
    {
        $data['title'] = 'Register Your Organization';

        if ($this->form_validation->run() === FALSE){

            $this->load->view('templates/header', $data);
            $this->load->view('organization/create');
            $this->load->view('templates/footer');

        }else{

            $this->organization_model->organization();
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
    }

    public function index(){
        $data['organization'] = $this->organization_model->get_organizations();
        $data['title'] = 'List of Organizations';

        $this->load->view('templates/header_tables', $data);
        $this->load->view('organization/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug){
        $data['organization'] = $this->organization_model->get_organizations($slug);

        if(empty($data['organization'])){
            show_404();
        }
        $data['title'] = 'Organization_Name ' . $slug;

        $this->load->view('templates/header', $data);
        $this->load->view('organization/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($slug){
        $organization = $this->organization_model->find_by_id($slug);
        $data['Organization'] = $organization;

        $data['title'] = 'Edit Your Profile';

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('organization/edit', $data);
            $this->load->view('templates/footer');

        }else{
            $new_data = array(
                'Organization_ID' => $this->input->post('ORGANIZATION_ID'),
                'Organization_Name' => $this->input->post('Organization_Name'),
                'Organization_Sponsor' => $this->input->post('Organization_Sponsor')
            );

            $this->organization_model->update($new_data);
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer');
        }
     }

    public function delete($slug){
        $this->organization_model->delete($slug);

        $data['title']="Deleted Organization";
        $this->load->view('templates/header', $data);
        $this->load->view('news/success');
        $this->load->view('templates/footer');
    }
}
	
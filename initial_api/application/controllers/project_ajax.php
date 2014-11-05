<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Project_ajax extends REST_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        $this->load->model('project_model');

    }

    public function add_project_post(){

        $data = array(
            'project_title' => $this->post('project_title'),
            'project_description' => $this->post('project_description'),

            'project_user_id' => $this->post('project_user_id'),
            'project_account_id' => $this->post('project_account_id')
        );

        $project_id = $this->project_model->add_project($data);

        if($project_id){

            $this->response($project_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    public function projects_get(){

        $projects = $this->project_model->get_projects_via_account_id($this->get('account_id'));

        if($projects){

            $this->response($projects, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    public function project_get(){

        $project_id = $this->project_model->get_project_via_project_id($this->get('project_id'));

        if($project_id){

            $this->response($project_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

}

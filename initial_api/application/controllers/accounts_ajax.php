<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Accounts_ajax extends REST_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        $this->load->model('account_model');

    }

    /**
     * Get an account
     */
    public function account_get(){

        $account_id = $this->account_model->get_account($this->get('account_id'));

        if($account_id){

            $this->response($account_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get all accounts
     */
    public function accounts_get(){

        $accounts = $this->account_model->get_accounts();

        if($accounts){

            $this->response($accounts, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Add an account
     */
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

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Jobs_ajax extends REST_Controller {

    var $billing_account_id;

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        $this->load->model('job_model');

        $this->billing_account_id = 1;

    }

    /**
     * Get an account
     */
    public function job_get(){

        $job_id = $this->job_model->get_job($this->get('job_id'));

        if($job_id){

            $this->response($job_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get all jobs
     */
    public function jobs_get(){

        $jobs = $this->job_model->get_jobs_via_billing_account_id($this->billing_account_id);

        if($jobs){

            $this->response($jobs, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get all people from a job
     */
    public function people_get(){

        $this->load->model('person_model');

        $people = $this->person_model->get_people_via_job_id($this->get('job_id'), $this->billing_account_id);

        if($people){

            $this->response($people, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Add an account
     */
    public function add_job_post(){

        $data = array(
            'job_number' => $this->post('job_number'),
            'job_billing_account_id' => 1
        );

        $job_id = $this->job_model->add_job($data);

        if($job_id){

            $this->response($job_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     *
     */
    public function update_job_post(){

        $data = array(
            'job_id' => $this->post('job_id'),
            'job_name' => $this->post('job_name'),
            'job_address_line_1' => $this->post('job_address_line_1'),
            'job_city' => $this->post('job_city'),
            'job_region' => $this->post('job_region'),
            'job_postcode' => $this->post('job_postcode'),
            'job_email' => $this->post('job_email'),
            'job_phone' => $this->post('job_phone'),
            'job_website' => $this->post('job_website')
        );

        $job_id = $this->job_model->update_job($data);

        if($job_id){

            $this->response($job_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    public function delete_job_post(){

        $job_id = $this->job_model->delete_job($this->post('job_id'));

        if($job_id){

            $this->response($job_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    public function link_person_post(){

        $data = array(
            'job_person_job_id' => $this->post('job_id'),
            'job_person_person_id' => $this->post('person_id'),

            'job_person_billing_account_id' => 1
        );

        $job_person_id = $this->job_model->link_person($data);

        if($job_person_id){

            $this->response($job_person_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    public function unlink_person_post(){

        $data = array(
            'job_person_job_id' => $this->post('job_id'),
            'job_person_person_id' => $this->post('person_id'),

            'job_person_billing_account_id' => 1
        );

        $job_person_id = $this->job_model->unlink_person($data);

        if($job_person_id){

            $this->response($job_person_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

}

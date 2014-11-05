<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Test_ajax extends REST_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        $this->load->model('test_model');

    }

    /**
     * Add single test
     */
    public function add_test_post(){

        $data = array(
            'test_title' => $this->post('test_title'),
            'test_description' => $this->post('test_description'),

            'test_project_id' => $this->post('test_project_id'),
            'test_user_id' => $this->post('test_user_id'),
            'test_account_id' => $this->post('test_account_id')
        );

        $test_id = $this->test_model->add_test($data);

        if($test_id){

            $this->response($test_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get single test
     */
    public function test_get(){

        $test_id = $this->test_model->get_test($this->get('test_id'));

        if($test_id){

            $this->response($test_id, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * Get all tests
     */
    public function tests_get(){

        // Get tests via account id
        if($this->get('account_id')){

            $tests = $this->test_model->get_tests_via_account_id($this->get('account_id'));

            if($tests){

                $this->response($tests, 200);

            }
            else{

                $this->response(null, 404);

            }

        }
        // Get tests via project id
        elseif($this->get('project_id')){

            $tests = $this->test_model->get_tests_via_project_id($this->get('project_id'));

            if($tests){

                $this->response($tests, 200);

            }
            else{

                $this->response(null, 404);

            }

        }

    }

}

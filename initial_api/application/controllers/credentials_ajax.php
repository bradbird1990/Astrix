<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Credentials_ajax extends REST_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

        $this->load->model('user_model');

    }

    public function login_post(){

        $user_email = $this->post('user_email');
        $user_password = $this->post('user_password');

        $user = $this->user_model->login($user_email, $user_password);

        if($user){

            $this->response($user, 200);

        }
        else{

            $this->response(null, 404);

        }

    }

    /**
     * todo This is not secure!
     */
    public function session_register_post(){

        $this->session->set_userdata(array(
            'user_id' => $this->post('user_id'),
            'user_email' => $this->post('user_email'),
            'billing_account_id' => $this->post('billing_account_id')
        ));

        /*$this->user_model->update_login_timestamp($this->post('user_id'));*/

        $this->response(null, 200);

    }

}

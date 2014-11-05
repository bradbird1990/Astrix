<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credentials extends Base_Controller {

    /**
     * Talk about this controller
     */
    public function __construct(){

        parent::__construct();

    }

    public function index(){

        redirect('credentials/login');

    }

    public function login(){

        if($this->session->userdata('user_id')){

            redirect('dashboard');

        }

        $this->add_js_include('credentials_login.js');

        $this->load->view('header_default');
        $this->load->view('credentials_login');
        $this->load->view('footer_default');

    }

    public function logout(){

        $this->session->sess_destroy();

        redirect('credentials');

    }

}

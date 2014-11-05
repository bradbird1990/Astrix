<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends Base_Controller {

	/*
	 * Talk about this controller
	 */
    public function __construct(){

        parent::__construct();

        if($this->session->userdata('user_id') == false){

            redirect('credentials');

        }

    }

	public function index(){

        $this->add_js_include('projects.js');

		$this->load->view('header_default');
		$this->load->view('projects');
		$this->load->view('footer_default');

	}

}

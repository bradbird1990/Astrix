<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Base_Controller {

	/*
	 * Talk about this controller
	 */
    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('user_id')){

            redirect('credentials');

        }

    }

	public function index(){

        if(!$this->uri->segment(1)){

            redirect('dashboard');

        }

        $this->add_js_include('dashboard.js');

		$this->load->view('header_default');
		$this->load->view('dashboard');
		$this->load->view('footer_default');

	}

}

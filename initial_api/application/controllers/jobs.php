<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends Base_Controller {

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

        $this->add_js_include('jobs.js');

		$this->load->view('header_default');
		$this->load->view('jobs');
		$this->load->view('footer_default');

	}

    public function view(){

        $this->add_js_include('jobs_view.js');

        $this->load->view('header_default');
        $this->load->view('jobs_view');
        $this->load->view('footer_default');

    }

}

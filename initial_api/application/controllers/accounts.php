<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends Base_Controller {

    public function __construct(){

        parent::__construct();

        if(!$this->session->userdata('user_id')){

            redirect('credentials');

        }

    }

	public function index(){

        $this->add_js_include('accounts.js');

		$this->load->view('header_default');
		$this->load->view('accounts');
		$this->load->view('footer_default');

	}

    public function view(){

        $this->add_js_include('accounts_view.js');

        $this->load->view('header_default');
        $this->load->view('accounts_view');
        $this->load->view('footer_default');

    }

}

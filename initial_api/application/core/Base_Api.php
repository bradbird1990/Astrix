<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Base_Api extends REST_Controller {

    public function __construct(){

        parent::__construct();

    }

}

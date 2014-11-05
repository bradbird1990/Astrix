<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Character extends REST_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('character_model');

    }

    /**
     * Get all character bags
     */
    public function bags_get(){

        $bags = $this->character_model->get_bags($this->get('character_id'));

        $bags ? $this->response($bags, 200) : $this->response(null, 404);

    }

}

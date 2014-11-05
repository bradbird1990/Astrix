<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');

class Characters extends REST_Controller {

    public function __construct(){

        parent::__construct();

        $this->load->model('character_model');

    }

    /**
     * Get all characters
     * Todo: This needs to work so that /characters/ on it's own returns all characters with no additional URI segments
     */
    public function index(){

        $characters = $this->character_model->get_characters();

        $characters ? $this->response($characters, 200) : $this->response(null, 404);

    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model {

    /**
     * Talk about this model
     */
    public function __construct(){

        parent::__construct();

    }

    public function add_test($data){

        $this->db
            ->insert('tests', $data);

        return $this->db->insert_id();

    }

    public function get_tests_via_account_id($account_id){

        $this->db
            ->from('tests')
            ->where('test_account_id', $account_id)
            ->where('test_deleted', 0);

        return $this->db->get()->result();

    }

    public function get_tests_via_project_id($project_id){

        $this->db
            ->from('tests')
            ->where('test_project_id', $project_id)
            ->where('test_deleted', 0);

        return $this->db->get()->result();

    }

}

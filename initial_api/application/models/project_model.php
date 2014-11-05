<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

    /**
     * Talk about this model
     */
    public function __construct(){

        parent::__construct();

    }

    public function add_project($data){

        $this->db
            ->insert('projects', $data);

        return $this->db->insert_id();

    }

    public function get_projects_via_account_id($account_id){

        $this->db
            ->from('projects')
            ->where('project_account_id', $account_id)
            ->where('project_deleted', 0);

        return $this->db->get()->result();

    }

    public function get_project_via_project_id($project_id){

        $this->db
            ->from('projects')
            ->where('project_id', $project_id)
            ->where('project_deleted', 0);

        return $this->db->get()->result();

    }

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model {

    /**
     * Talk about this model
     */
    public function __construct(){

        parent::__construct();

    }

    public function get_account($account_id){

        $this->db
            ->from('accounts')
            ->where('account_id', $account_id)
            ->where('account_deleted', 0)
            ->limit(1);

        return $this->db->get()->result();

    }

    public function get_accounts(){

        $this->db
            ->from('accounts');

        return $this->db->get()->result();

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

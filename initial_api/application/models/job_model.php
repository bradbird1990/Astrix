<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model {

    /**
     * Talk about this model
     */
    public function __construct(){

        parent::__construct();

    }

    public function get_job($job_id){

        $this->db
            ->from('jobs')
            ->where('job_id', $job_id)
            ->limit(1);

        return $this->db->get()->result(0);

    }

    public function get_jobs(){

        $this->db
            ->from('jobs');

        return $this->db->get()->result();

    }

    public function get_jobs_via_billing_account_id($billing_account_id){

        $this->db
            ->from('jobs')
            ->where('job_billing_account_id', $billing_account_id)
            ->where('job_deleted', 0);

        return $this->db->get()->result();

    }

    public function get_jobs_via_person_id($person_id, $billing_account_id){

        $this->db
            ->from('jobs')
            ->join('jobs_people', 'job_person_job_id = job_id')
            ->where('job_person_person_id', $person_id)
            ->where('job_deleted', 0);

        return $this->db->get()->result();

    }

    public function get_project_via_project_id($project_id){

        $this->db
            ->from('projects')
            ->where('project_id', $project_id)
            ->where('project_deleted', 0);

        return $this->db->get()->result();

    }

    public function add_job($data){

        $this->db
            ->insert('jobs', $data);

        return $this->db->insert_id();

    }

    public function update_job($data){

        $this->db
            ->where('job_id', $data['job_id'])
            ->update('jobs', $data);

        return $this->db->affected_rows();

    }

    public function delete_job($id){

        $data = array(
            'job_deleted' => 1
        );

        $this->db
            ->where('job_id', $id)
            ->update('jobs', $data);

        return $this->db->affected_rows();

    }

    public function link_person($data){

        $this->db
            ->insert('jobs_people', $data);

        return $this->db->insert_id();

    }

    public function unlink_person($data){

        $this->db
            ->where('job_person_person_id', $data['job_person_person_id'])
            ->where('job_person_job_id', $data['job_person_job_id'])
            ->delete('jobs_people');

        return $this->db->affected_rows();

    }

}

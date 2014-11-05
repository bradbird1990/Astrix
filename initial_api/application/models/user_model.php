<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * Talk about this model
     */
    public function __construct(){

        parent::__construct();

    }

    public function get_user($user_id){

        $this->db
            ->from('users')
            ->where('user_id', $user_id)
            ->where('user_deleted', 0)
            ->limit(1);

        return $this->db->get()->result();

    }

    public function login($user_email, $user_password){

        $this->db
            ->select('user_id, user_email, user_billing_account_id')
            ->from('users')
            ->where('user_email', $user_email)
            ->where('user_password', $user_password)
            ->where('user_deleted', 0)
            ->limit(1);

        return $this->db->get()->result();

    }

    public function update_login_timestamp($user_id){

        $data = array(
            'user_login_user_id' => $user_id
        );

        $this->db
            ->insert('user_logins', $data);

        return $this->db->insert_id();

    }

}
